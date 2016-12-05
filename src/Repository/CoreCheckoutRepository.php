<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Checkout\Repository;

/**
 * Description of CoreCheckoutRepository
 *
 * @author dev
 */
use Doctrine\ORM\EntityRepository;

class CoreCheckoutRepository extends EntityRepository
{
    public function create($data)
    {
        
    }
    

    /**
     * Obtiene usuario mediante username
     * 
     * @param type $username
     * @return type
     */
    public function getUserByUsername($username)
    {
        return $this->_em->getRepository(OauthUsers::class)
                ->createQueryBuilder('U')
                ->select('U.id,U.displayName')
                ->where('U.username = :username')
                ->setParameter('username', $username)
                ->getQuery()->getSingleResult();
    }   
    
    
}
