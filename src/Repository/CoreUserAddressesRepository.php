<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Adteam\Core\Admin\Checkout\Repository;
/**
 * Description of CoreUserAddressesRepository
 *
 * @author dev
 */
use Doctrine\ORM\EntityRepository;
use Adteam\Core\Admin\Checkout\Entity\OauthUsers;
use Adteam\Core\Admin\Checkout\Entity\CoreOrders;
use Adteam\Core\Admin\Checkout\Entity\CoreOrderAddressses;

class CoreUserAddressesRepository extends EntityRepository{
   
    
    /**
     * 
     * @param type $idOrder
     * @param type $params
     * @throws \InvalidArgumentException
     */
    public function insertCoreAdresess($idOrder,$address,$params)
    {

        $user= $this->_em->getReference(
                OauthUsers::class, $params['identity']['id']);
        $order= $this->_em->getReference(CoreOrders::class, $idOrder);
        $corecrderaddressses = new CoreOrderAddressses();
        foreach ($address as $key=>$value){
            $corecrderaddressses->setOrder($order);
            $corecrderaddressses->setUser($user);

            if (method_exists($corecrderaddressses, 'set'.ucfirst($key))) {                
                $corecrderaddressses->{'set'.ucfirst($key)}($value);
            }
            else{
                throw new \InvalidArgumentException(
                'Faltan campos de Direccion'); 
            }                
        }
        $this->_em->persist($corecrderaddressses);
        $this->_em->flush();             

    }
    
    public function getAddreses($userId)
    {
        try{
            $result = $this->createQueryBuilder('T')
                ->select('T.street,T.extNumber,T.intNumber,T.zipCode,T.reference,'.
                        'T.location,T.city,T.town,T.state')
                ->where('T.user = :user_id')
                ->setParameter('user_id', $userId)
                ->getQuery()
                ->getSingleResult();   
            return $result;
        } catch (\Exception $ex) {
            return false;
        }
    }
}
