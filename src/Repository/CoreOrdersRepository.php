<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Admin\Checkout\Repository;

use Doctrine\ORM\EntityRepository;
use Adteam\Core\Admin\Checkout\Entity\CoreOrders;
use Adteam\Core\Admin\Checkout\Entity\CoreUserTransactions;
use Adteam\Core\Admin\Checkout\Entity\OauthUsers;
use Adteam\Core\Admin\Checkout\Entity\CoreProducts;
use Adteam\Core\Admin\Checkout\Entity\CoreOrderProducts;
/**
 * Description of CoreOrdersRepository
 *
 * @author dev
 */
class CoreOrdersRepository extends EntityRepository 
{

    public function fetchAll($params)
    {
        return $this->createQueryBuilder('O')
               ->select("O.id,O.createdAt,U.id as userId ,C.id as createdById, O.total")
               ->innerJoin('O.user', 'U')
               ->innerJoin('O.createdBy', 'C')
               ->where("O.deletedAt IS NULL")            
               ->getQuery()->getResult();
    }
    
    public function fetch($id)
    {
        return $this->createQueryBuilder('O')
               ->select("O.id,O.createdAt,U.id as userId ,C.id as createdById, O.total")
               ->innerJoin('O.user', 'U') 
               ->innerJoin('O.createdBy', 'C')
               ->where("O.deletedAt IS NULL") 
               ->andWhere('O.id = :id') 
               ->setParameter('id', $id)
               ->getQuery()->getOneOrNullResult();      
    }
    
    public function delete($id)
    {
        if(!$this->isDelete($id)){
            $this->createQueryBuilder('o')
                 ->update(CoreOrders::class,'o')
                 ->set('o.deletedAt',':deletedAt')  
                 ->setParameter('deletedAt', $this->formatTimestamp('Y-m-d H:i:s'))
                 ->where('o.id = :id')
                 ->setParameter('id', $id)
                 ->getQuery()->execute();  
            return true;
        }

    }
    
    public function create($data)
    {
        $currentRepo = $this;        
        return $this->_em->transactional(
            function ($em) use($currentRepo,$data) {
            $userId = $this->_em->getReference(
                    OauthUsers::class, $data['identity']['id']);
                $coreorders = new CoreOrders();
                $coreorders->setUser($userId);           
                $createdBy = $this->_em->getReference(
                    OauthUsers::class, $data['createdById']);
                $coreorders->setCreatedBy($createdBy);
                $coreorders->setTotal($data['totalcart']);
                $coreorders->setRevision(1);
                $em->persist($coreorders); 
                $em->flush();
                $id = $coreorders->getId();
                $currentRepo->insertCoreProducts($id, $data);
                $currentRepo->insertTransaction($data, $id);
                return $id;
            }
        );        
    }            

    private function isDelete($id)
    {
        $isDelete = true;
        try{
            $result = $this
                    ->createQueryBuilder('U')
                    ->select('U.deletedAt')
                    ->where('U.id = :id')
                    ->andWhere("U.deletedAt IS NULL") 
                    ->setParameter('id', $id)
                    ->getQuery()->getSingleResult(); 
            if(isset($result['deletedAt'])||is_null($result['deletedAt'])){
                $isDelete = false;
            }
            return $isDelete;            
        } catch (\Exception $ex) {
            throw new \InvalidArgumentException(
                        'Entity not found.'); 
        }

    } 
    
    private function formatTimestamp($format='d-m-Y H:i:s'){
        $date = new \DateTime('now', new \DateTimeZone('America/Mexico_City'));
        return $date->format($format);
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
                        CoreProducts::class, $items['id']);
                $coreorderproducts->setProduct($product);
                if (method_exists($coreorderproducts, 'set'.ucfirst($key))
                        &&$key!=='id') {                
                    $coreorderproducts->{'set'.ucfirst($key)}($value);  
                }
            }
            $this->_em->persist($coreorderproducts);
            $this->_em->flush();  
        }        
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
}
