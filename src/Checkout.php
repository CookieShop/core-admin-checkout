<?php
/**
 * Helper para formatear en json paginador
 * 
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @author Ing. Eduardo Ortiz
 * 
 */
namespace Adteam\Core\Checkout;

use Adteam\Core\Checkout\Checkout\Steps;
use Zend\ServiceManager\ServiceManager;
use Adteam\Core\Checkout\Entity\OauthUsers;
use Doctrine\ORM\EntityManager;
use Adteam\Core\Checkout\Entity\CoreUserCartItems;
use Adteam\Core\Checkout\Entity\CoreConfigs;
use Adteam\Core\Checkout\Validator;
use Adteam\Core\Checkout\Entity\CoreUserTransactions;
use Adteam\Core\Checkout\Entity\CoreOrders;
use Adteam\Core\Checkout\Entity\CoreSurveyQuestions;

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
    
    /**
     * 
     * @param ServiceManager $service
     */
    public function __construct(ServiceManager $service) {
        $this->service = $service;
        
        $this->identity = $this->service->get('authentication')
                ->getIdentity()->getAuthenticationIdentity();
        $this->em = $service->get(EntityManager::class);        
    }
    
    /**
     * 
     * @return type
     */
    public function getSteps()
    {
        $step = new Steps($this->service);
        return $step->getSettings();
    }
    
    /**
     * 
     * @param type $data
     */
    public function create($data)
    {
        $identity = $this->getUserByUsername($this->identity['user_id']); 
        $cart = $this->getCart($identity['id']);
        $params = [
                'identity'=>$this->getUserByUsername($this->identity['user_id']),
                'cart'=>$cart,
                'configs'=>$this->getConfigs(),
                'balance'=>$this->getBalance($identity['id']),
                'survey' =>isset($data->answers)?$data->answers:null,
                'totalcart'=>  $this->getTotalCart($cart),
                'data'=>$data
                ];
        $validator = new Validator($params);
        if($validator->isValid()){
            $this->saveSurvey($params);
            return $this->insertOrders($params,$data);
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
        return $this->em->getRepository(OauthUsers::class)
                ->createQueryBuilder('U')
                ->select('U.id,U.displayName,U.username')
                ->where('U.username = :username')
                ->setParameter('username', $username)
                ->getQuery()->getSingleResult();
    }    
    
    /**
     * 
     * @param type $userId
     * @return type
     */
    public function getCart($userId)
    {
       return $this->em->getRepository(CoreUserCartItems::class)
                ->createQueryBuilder('U')
                ->select('R.id,P.id as product,P.sku,P.description,P.brand'.
                        ',P.title,P.realPrice,P.price,P.payload,U.quantity')
                ->innerJoin('U.user', 'R')
                ->innerJoin('U.product', 'P')
                ->where('R.id = :id')
                ->setParameter('id', $userId)
                ->getQuery()->getScalarResult(); 
       
    }
    
    /**
     * 
     * @return array
     */
    public function getConfigs()
    {
        $em = $this->service->get(EntityManager::class);
        $config = $em->getRepository(CoreConfigs::class)->getConfig();
        $key = $em->getRepository(CoreConfigs::class)->getKey('checkout.enabled'); 
        $config[$key['key']]=$key['value'];
        return $config;
    } 
    
    /**
     * 
     * @param type $userId
     * @return type
     */
    public function getBalance($userId)
    {
       return $this->em->getRepository(CoreUserTransactions::class)
                ->createQueryBuilder('U')
                ->select('SUM(U.amount) as amount')
                ->innerJoin('U.user', 'R')
                ->where('R.id = :id')
                ->setParameter('id', $userId)
                ->getQuery()->getSingleResult();         
    }
    
    public function insertOrders($params,$data)
    {
        $em = $this->em->getRepository(CoreOrders::class);
        return $em->create($params,$data);
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
    
    private function saveSurvey($params)
    {
        $isMandatory = isset($params['configs']['survey.isMandatory'])?
                (boolean)$params['configs']['survey.isMandatory']:false;
        if($isMandatory){
            $em = $this->em->getRepository(CoreSurveyQuestions::class);
            return $em->save($params);            
        }
    }

}
