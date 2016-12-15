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
use Adteam\Core\Admin\Checkout\Entity\CoreOrderAddressses;
use Adteam\Core\Admin\Checkout\Entity\CoreOrderCedis;
use Adteam\Core\Admin\Checkout\Entity\CoreCedis;
use Adteam\Core\Admin\Checkout\Entity\CoreUserAddresses;
use Adteam\Core\Admin\Checkout\Entity\CoreUserCedis;
use DateTime;
use DateTimeZone;

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
     * @return type
     */
    public function fetchAll($params)
    {
        $entities = [];
        $result = $this->createQueryBuilder('O')
               ->select("O.id,O.createdAt,U.id as userId ,C.id as createdById, O.total,O.deletedAt")
               ->innerJoin('O.user', 'U')
               ->innerJoin('O.createdBy', 'C')
//               ->where("O.deletedAt IS NULL")            
               ->getQuery()->iterate();
       foreach ($result as $items){           
           $item = reset($items);
           $entities[] = [
               'id'=>$item['id'],
               'createdAt'=>  $this->formatObjectDateTime($item['createdAt']),
               'user'=>  $this->getUser($item['userId']),
               'createdBy'=>$this->getUser($item['createdById']),
               'total'=>$item['total'],
               'delete'=>is_null($item['deletedAt'])?0:1
           ]; 
       }
      return $entities;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function fetch($id,$url)
    {
        $entities = [];
        $result = $this->createQueryBuilder('O')
               ->select("O.id,O.createdAt,U.id as userId ,C.id as createdById, O.total,O.deletedAt")
               ->innerJoin('O.user', 'U') 
               ->innerJoin('O.createdBy', 'C')
//               ->where("O.deletedAt IS NULL") 
               ->Where('O.id = :id') 
               ->setParameter('id', $id)
               ->getQuery()->iterate();  
       foreach ($result as $items){  
           $item = reset($items);
           $entities = [
               'id'=>$item['id'],
               'createdAt'=>  $this->formatObjectDateTime($item['createdAt']),
               'user'=>  $this->getUser($item['userId'],false),
               'createdBy'=>$this->getUser($item['createdById'],false),
               'address'=>  $this->getAdress($id),
               'cedis'=>  $this->getCedis($id),
               'items'=>  $this->getProducts($id,$url),
               'total'=>$item['total'],
               'delete'=>is_null($item['deletedAt'])?null:$this->formatObjectDateTime($item['deletedAt'])
           ]; 
       }
      return $entities;        
    }
    
    /**
     * 
     * @param type $id
     * @return boolean
     */
    public function delete($id)
    {
        if(!$this->isDelete($id)){
            $currentRepo = $this;
            return $this->_em->transactional(
                function ($em) use($currentRepo,$id) {
                    $currentRepo->createQueryBuilder('o')
                    ->update(CoreOrders::class,'o')
                    ->set('o.deletedAt',':deletedAt')  
                    ->setParameter('deletedAt', $this->formatTimestamp('Y-m-d H:i:s'))
                    ->where('o.id = :id')
                    ->setParameter('id', $id)
                    ->getQuery()->execute();  
               $order = $currentRepo->fetch($id);
               $em->getRepository(CoreUserTransactions::class)
              ->setTransactionsByCancell($id,$order['total'],$order['user']['id']);  
              return true;               
            });
        }

    }
    
    /**
     * 
     * @param type $data
     * @return type
     */
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
                $currentRepo->insertCoreAdresess($id, $data['identity']['id'],$data);
                $currentRepo->insertCedis($data,$id);                
                return $id;
            }
        );        
    }            

    /**
     * 
     * @param type $id
     * @return boolean
     * @throws \InvalidArgumentException
     */
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
    
    /**
     * 
     * @param type $format
     * @return type
     */
    private function formatTimestamp($format='d-m-Y H:i:s'){
        $date = new DateTime('now', new DateTimeZone('America/Mexico_City'));
        return $date->format($format);
    }  
    
    /**
     * 
     * @param DateTime $datetime
     * @param type $format
     * @return type
     */
    private function formatObjectDateTime(DateTime $datetime,$format='d-m-Y H:i:s')
    {
        $datetime->setTimezone(new DateTimeZone('America/Mexico_City'));
        return $datetime->format($format);
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
     * @param type $idOrder
     * @param type $params
     * @throws \InvalidArgumentException
     */
    public function insertCoreAdresess($idOrder,$userId,$data)
    {
        $result = $this->getUserAddress($userId);
        if($result!==false){
            return $this->_em->getRepository(CoreUserAddresses::class)
                    ->insertCoreAdresess($idOrder,$result,$data);              
        }
    }

    public function getUserAddress($userId)
    {
        return $this->_em->getRepository(CoreUserAddresses::class)
                ->getAddreses($userId);        
    }

    public function insertCedis($params,$orderId)
    {
        $result =  $this->_em->getRepository(CoreUserCedis::class)
                ->getCedis($params['identity']['id']);
        if($result!==false){
            $result =  $this->_em->getRepository(CoreOrderCedis::class)
                    ->insertCedis($orderId,$result['id']);
             
        }
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
    
    /**
     * 
     * @param type $userId
     * @param type $basic
     * @return type
     */
    public function getUser($userId,$basic=true)
    {
        $result =  $this->_em->getRepository(OauthUsers::class)
                ->findOneBy(array('id'=>$userId));
        if(is_null($result)){
            return [];
        }
        if($basic){
            return [
                    'id'=>$result->getId(),
                    'displayName'=>$result->getDisplayName()
                   ];            
        }else{
            return [
                    'id'=>$result->getId(),
                    'username'=>$result->getUsername(),                    
                    'firstName'=>$result->getFirstName(),
                    'lastName'=>$result->getLastName(),
                    'surname'=>$result->getSurname(),
                    'email'=>$result->getEmail(),
                    'displayName'=>$result->getDisplayName(),
                    'telephone1'=>$result->getTelephone1(),
                    'telephone2'=>$result->getTelephone1(),
                    'mobile'=>$result->getMobile()                    
                   ];            
        }
    }
    
    /**
     * 
     * @param type $orderId
     * @return type
     */
    public function getAdress($orderId)
    {
        $order= $this->_em->getReference(
                CoreOrderAddressses::class, $orderId);        
        $result =  $this->_em->getRepository(CoreOrderAddressses::class)
                ->findOneBy(array('order'=>$order));
        if(is_null($result)){
            return [];
        }        
        return [
                'street'=>$result->getStreet(),                    
                'extNumber'=>$result->getExtNumber(),
                'intNumber'=>$result->getIntNumber(),
                'zipCode'=>$result->getZipCode(),
                'reference'=>$result->getReference(),
                'city'=>$result->getCity(),
                'town'=>$result->getTown(), 
                'state'=>$result->getState()
               ];         
    }  
    
    /**
     * 
     * @param type $orderId
     * @return type
     */
    public function getCedis($orderId)
    {
        $order= $this->_em->getReference(
                CoreOrderCedis::class, $orderId);     
        $result =  $this->_em->getRepository(CoreOrderCedis::class)
                ->findOneBy(array('order'=>$order));
        if(is_null($result)){
            return [];
        }
        $cedis =  $this->_em->getRepository(CoreCedis::class)
                ->findOneBy(array('id'=>$result->getCedis()->getId()));
        return [
                'cedisId'=>$cedis->getCedisId(),                    
                'namesCedis'=>$cedis->getNamesCedis(),
                'street'=>$cedis->getStreet(),
                'extNumber'=>$cedis->getExtNumber(),
                'intNumber'=>$cedis->getIntNumber(),
                'location'=>$cedis->getLocation(),
                'reference'=>$cedis->getReference(),
                'city'=>$cedis->getCity(),
                'state'=>$cedis->getState(),
                'zipCode'=>$cedis->getZipCode(),
                'telephone'=>$cedis->getTelephone(),
                'extra'=>$cedis->getExtra()
               ];         
    }  
    
    /**
     * 
     * @param type $orderId
     * @return type
     */
    public function getProducts($orderId,$url)
    {
        $entities= [];
        
        $order= $this->_em->getReference(CoreOrders::class, $orderId);     
        $result =  $this->_em->getRepository(CoreOrderProducts::class)
                ->findBy(['order'=>$order]);  
        foreach ($result as $item){            
            $entities[] =  [
                'productId'=>$item->getProduct()->getId(),                    
                'sku'=>$item->getSku(),
                'description'=>$item->getDescription(),
                'brand'=>$item->getBrand(),
                'fileName'=> $url.$this->getImage($item->getProduct()->getId()),
                'title'=>$item->getTitle(),
                'price'=>$item->getPrice(),
                'quantity'=>$item->getQuantity(),
                'lineTotal'=>$item->getPrice()*$item->getQuantity()
               ];
        }
        return $entities;         
    }
    
    public function getImage($productId)
    {
        $result =  $this->_em->getRepository(CoreProducts::class)
                ->findOneBy(array('id'=>$productId));
        if(!is_null($result)){
            return $result->getFileName();
        }
        return '';
    }
}
