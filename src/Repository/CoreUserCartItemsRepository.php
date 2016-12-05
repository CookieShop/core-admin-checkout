<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Checkout\Repository;

/**
 * Description of CoreUserCartItemsRepository
 *
 * @author dev
 */
use Doctrine\ORM\EntityRepository;

class CoreUserCartItemsRepository extends EntityRepository
{
    //put your code here
    public function remove($params)
    {
        $s = (int) $params['identity']['id'];
        $dql ="DELETE  FROM Adteam\Core\Checkout\Entity\CoreUserCartItems U WHERE U.user =".$s;
        return $this->_em->createQuery($dql)->getResult();        
    }
    
}
