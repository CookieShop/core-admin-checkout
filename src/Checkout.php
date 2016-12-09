<?php
/**
 * Helper para formatear en json paginador
 * 
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @author Ing. Eduardo Ortiz
 * 
 */
namespace Adteam\Core\Admin\Checkout;

use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceManager;
use Adteam\Core\Admin\Checkout\Entity\CoreOrders;
use Adteam\Core\Admin\Checkout\Entity\OauthUsers;
use Adteam\Core\Admin\Checkout\Entity\CoreProducts;
use Adteam\Core\Admin\Checkout\Entity\CoreUserTransactions;
use Adteam\Core\Admin\Checkout\Validator;
use Adteam\Core\Common\ViewHelper;
class Checkout
{
    /**
     *
     * @var type 
     */
    protected $service;
    
    /**
     *
     * @var type 
     */
    protected $identity;
    
    /**
     *
     * @var type 
     */
    protected $em;
    
    protected  $url;
    /**
     * 
     * @param ServiceManager $service
     */
    public function __construct(ServiceManager $service) {
        $this->service = $service;
        
        $this->identity = $this->service->get('authentication')
                ->getIdentity()->getAuthenticationIdentity();
        $this->em = $service->get(EntityManager::class);   
        $ViewHelper = new ViewHelper($service);
        $this->url = $ViewHelper->getUrl('img/');
    }
    
    public function fetchAll($params)
    {
        return $this->em->getRepository(CoreOrders::class)->fetchAll($params,$this->url);
    }
    
    public function fetch($id)
    {
        return $this->em->getRepository(CoreOrders::class)->fetch($id,$this->url);
    }
    
    public function create($dataObject)
    {
        $items = (array)$dataObject;
        $cart = $this->setPrducts($items); 
        $userId = isset($items['userId'])?$items['userId']:0;
        $params = [
                'identity'=>$this->getUserById($userId),
                'createdById'=>$this->getUserByUsername($this->identity['user_id']),
                'cart'=>$cart,
                'balance'=>$this->getBalance($userId),
                'totalcart'=>  $this->getTotalCart($cart)
                ];   
        $validator = new Validator($params);
        if($validator->isValid()){
            return $this->insertOrders($params);
        }            
    }
    
    public function insertOrders($items)
    {
        $em = $this->em->getRepository(CoreOrders::class);
        return $em->create($items);
    }
    
    public function delete($id)
    {
        return $this->em->getRepository(CoreOrders::class)->delete($id);
    }
    
    /**
     * Obtiene usuario mediante username
     * 
     * @param type $username
     * @return type
     */
    public function getUserById($id)
    {
        try{
            return $this->em->getRepository(OauthUsers::class)
                    ->createQueryBuilder('U')
                    ->select('U.id,U.displayName,U.username')
                    ->where('U.id = :id')
                    ->setParameter('id', $id)
                    ->getQuery()->getSingleResult();            
        } catch (\Exception $ex) {
            return null;
        }
    } 
    
    
    /**
     * Obtiene usuario mediante username
     * 
     * @param type $username
     * @return type
     */
    public function getUserByUsername($username)
    {
        try{
            return $this->em->getRepository(OauthUsers::class)
                    ->createQueryBuilder('U')
                    ->select('U.id,U.displayName,U.username')
                    ->where('U.username = :username')
                    ->setParameter('username', $username)
                    ->getQuery()->getSingleResult();            
        } catch (\Exception $ex) {
            return null;
        }
    } 
    
    public function setPrducts($items)
    {
        $entities = [];
        $products = isset($items['products'])?$items['products']:[];
        foreach ($products as $item){
            try{
                $producto = $this->em->getRepository(CoreProducts::class)
                        ->createQueryBuilder('P')
                        ->select('P.id,P.sku,P.description,P.brand,P.title,P.realPrice,P.price,P.payload')
                        ->where('P.id = :id')
                        ->setParameter('id', $item['id'])
                        ->andWhere('P.enabled = 1')
                        ->getQuery()->getSingleResult();
                $producto['quantity']=$item['quantity'];
                $entities[] = $producto;
            } catch (\Exception $ex) {

            }
        }
        return $entities;
    }
    
    /**
     * 
     * @param type $userId
     * @return type
     */
    public function getBalance($userId)
    {
        try{
            return $this->em->getRepository(CoreUserTransactions::class)
                    ->createQueryBuilder('U')
                    ->select('SUM(U.amount) as amount')
                    ->innerJoin('U.user', 'R')
                    ->where('R.id = :id')
                    ->setParameter('id', $userId)
                    ->getQuery()->getSingleResult(); 
        } catch (\Exception $ex) {
            return 0;
        }
        
    }    

    /**
     * 
     * @param type $cart
     * @return type
     */
    private function getTotalCart($cart)
    {
        $total = 0;
        foreach ($cart as $item){
            $total += $item['price']*$item['quantity'];
        }
        return $total;        
    }    
    
}
