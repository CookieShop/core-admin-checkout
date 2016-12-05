<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Checkout\Repository;

use Doctrine\ORM\EntityRepository;

class CoreConfigsRepository extends EntityRepository
{
    /**
     * 
     * @return type
     */
    public function getConfig()
    {
        $items = [];
        $result = $this->createQueryBuilder('B')
               ->select("B.key, B.value")
               ->where("B.key in (:key)")
               ->setParameter('key', ['checkout.delivery.mode','survey.isMandatory'])
               ->getQuery()->getResult();
        foreach ($result as $item){
            $items[$item['key']]=$item['value'];
        }
        return $items;    
    }
    
    public function getKey($key)
    {
        return $this->createQueryBuilder('B')
               ->select("B.key, B.value")
               ->where("B.key = :key")
               ->setParameter('key', $key)
               ->getQuery()->getSingleResult();        
    }
}