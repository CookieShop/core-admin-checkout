<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Checkout\Repository;

/**
 * Description of CoreUserTransactionsRepository
 *
 * @author dev
 */
use Doctrine\ORM\EntityRepository;

class CoreUserTransactionsRepository extends EntityRepository
{
    /**
     * Get User Transaction balance
     * 
     * @param integer $userId
     * @return integer
     */
    public function getBalanceSnapshot($userId) 
    {
        return $this->createQueryBuilder('T')
            ->select('SUM(T.amount)')
            ->where('T.user = :user_id')
            ->setParameter('user_id', $userId)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
