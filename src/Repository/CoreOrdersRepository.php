<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Checkout\Repository;

use Adteam\Core\Checkout\Entity\CoreOrders;
use Adteam\Core\Checkout\Entity\OauthUsers;
use Doctrine\ORM\EntityRepository;
use Adteam\Core\Checkout\Entity\CoreOrderProducts;
use Adteam\Core\Checkout\Entity\CoreProducts;
use Adteam\Core\Checkout\Entity\CoreOrderAddressses;
use Adteam\Core\Checkout\Entity\CoreUserCartItems;
use Adteam\Core\Checkout\Entity\CoreUserTransactions;
use Adteam\Core\Checkout\Entity\CoreOrderCedis;
use Adteam\Core\Checkout\Entity\CoreCedis;
/**
 * Description of CoreOrdersRepository
 *
 * @author dev
 */
class CoreOrdersRepository extends EntityRepository 
{
    /**
     * 
     * @param type $params
     * @param type $data
     * @return type
     */
    public function create($params,$data)
    {
        $currentRepo = $this;        
        return $this->_em->transactional(
            function ($em) use($currentRepo,$params,$data) {

            $userId = $this->_em->getReference(
                    OauthUsers::class, $params['identity']['id']);
                $coreorders = new CoreOrders();
                $coreorders->setUser($userId);
                $coreorders->setTotal($params['totalcart']);
                $coreorders->setRevision(1);
                $em->persist($coreorders); 
                $em->flush();
                $id = $coreorders->getId();
                $currentRepo->insertCoreProducts($id, $params);
                $currentRepo->emptyCart($params); 
                $currentRepo->insertTransaction($params, $id);
                $currentRepo->insertCoreAdresess($id, $params);
                $currentRepo->insertCedis($params, $id);
                return $id;
            }
        );        
    }
    
    /**
     * 
     * @param type $idOrder
     * @param type $params
     */
    public function insertCoreProducts($idOrder,$params)
    {
        $order= $this->_em->getReference(CoreOrders::class, $idOrder);
        
        foreach ($params['cart'] as $items){
            $coreorderproducts = new CoreOrderProducts();
            $coreorderproducts->setOrder($order);            
            foreach ($items as $key=>$value){
                $product = $this->_em->getReference(
                        CoreProducts::class, $items['product']);
                $coreorderproducts->setProduct($product);
                if (method_exists($coreorderproducts, 'set'.ucfirst($key))
                        &&$key!=='id'&&$key!=='product') {                
                    $coreorderproducts->{'set'.ucfirst($key)}($value);  
                }
            }
            $this->_em->persist($coreorderproducts);
            $this->_em->flush();  
        }
        
        
    }
    
    /**
     * 
     * @param type $idOrder
     * @param type $params
     * @throws \InvalidArgumentException
     */
    public function insertCoreAdresess($idOrder,$params)
    {
        if(isset($params['data']->userAddress)){
            $user= $this->_em->getReference(
                    OauthUsers::class, $params['identity']['id']);
            $order= $this->_em->getReference(CoreOrders::class, $idOrder);
            $corecrderaddressses = new CoreOrderAddressses();
            foreach ($params['data']->userAddress as $key=>$value){
                $corecrderaddressses->setOrder($order);
                $corecrderaddressses->setUser($user);

                if (method_exists($corecrderaddressses, 'set'.ucfirst($key))) {                
                    $corecrderaddressses->{'set'.ucfirst($key)}($value);
                }
                else{
                    throw new \InvalidArgumentException(
                    'Faltan campos en Json de Direcciones'); 
                }                
            }
            $this->_em->persist($corecrderaddressses);
            $this->_em->flush();             
        }
    }
    
    /**
     * 
     * @param type $params
     */
    public function emptyCart($params)
    {
        $this->_em->getRepository(CoreUserCartItems::class)->remove($params);
    }
    
    /**
     * 
     * @param type $params
     * @param type $orderId
     */
    public function insertTransaction($params,$orderId)
    {
        $user= $this->_em->getReference(
                OauthUsers::class, $params['identity']['id']);
        $snap = $this->getBalanceSnapshop($params);   
        $CoreUserTransactions =  new CoreUserTransactions();
        $CoreUserTransactions->setUser($user);
        $CoreUserTransactions->setAmount(0-$params['totalcart']);
        $CoreUserTransactions->setType(CoreUserTransactions::TYPE_ORDER);
        $CoreUserTransactions->setCorrelationId($orderId);
        $CoreUserTransactions->setBalanceSnapshot($snap);
        $this->_em->persist($CoreUserTransactions);
        $this->_em->flush();        
    }
    
    /**
     * 
     * @param type $params
     * @return type
     */
    public function getBalanceSnapshop($params)
    {
        return $this->_em->getRepository(CoreUserTransactions::class)
                ->getBalanceSnapshot($params['identity']['id']);
    }
    
    public function insertCedis($params,$orderId)
    {
        if(isset($params['data']->cedis)){
            $order= $this->_em->getReference(CoreOrders::class, $orderId);
            $cedis= $this->_em->getReference(CoreCedis::class, $params['data']->cedis);
            try {
                $CoreOrderCedis =  new CoreOrderCedis();
                $CoreOrderCedis->setCedis($cedis);
                $CoreOrderCedis->setOrder($order);
                $this->_em->persist($CoreOrderCedis);
                $this->_em->flush();                  
            } catch (\Exception $ex) {
           throw new \InvalidArgumentException('Cedis no existe');                  
            }
             
        }
    }
    
}
