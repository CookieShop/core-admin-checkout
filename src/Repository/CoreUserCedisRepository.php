<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Admin\Checkout\Repository;

/**
 * Description of CoreUserCedisRepository
 *
 * @author dev
 */
use Doctrine\ORM\EntityRepository;

class CoreUserCedisRepository extends EntityRepository{

    public function getCedis($userId)
    {
        try{
            $result = $this->createQueryBuilder('T')
                ->select('C.id')
                ->innerJoin('T.cedis','C')   
                ->innerJoin('T.user','U')     
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
