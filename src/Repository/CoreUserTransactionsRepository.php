<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Admin\Checkout\Repository;

/**
 * Description of CoreUserTransactionsRepository
 *
 * @author dev
 */
use Doctrine\ORM\EntityRepository;
use Adteam\Core\Admin\Checkout\Entity\CoreUserTransactions;
use Adteam\Core\Admin\Checkout\Entity\OauthUsers;

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
    
    public function setTransactionsByCancell($CorrelationId,$amount,$userId)
    {
        $user= $this->_em->getReference(
                OauthUsers::class, $userId);
        $CoreUserTransactions = new CoreUserTransactions();
        $CoreUserTransactions->setUser($user);
        $CoreUserTransactions->setAmount($amount); 
        $CoreUserTransactions->setType(
                CoreUserTransactions::TYPE_ORDER_CANCELLATION);
        $CoreUserTransactions->setCorrelationId($CorrelationId);
        $snp = $this->getBalanceSnapshot($userId);
        $CoreUserTransactions->setBalanceSnapshot($snp);
        $this->_em->persist($CoreUserTransactions);
        $this->_em->flush();          
    }
   
}
