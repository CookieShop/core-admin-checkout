<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Admin\Checkout\Repository;

/**
 * Description of CoreOrderCedisRepository
 *
 * @author dev
 */
use Doctrine\ORM\EntityRepository;
use Adteam\Core\Admin\Checkout\Entity\CoreOrderCedis;
use Adteam\Core\Admin\Checkout\Entity\CoreOrders;
use Adteam\Core\Admin\Checkout\Entity\CoreCedis;

class CoreOrderCedisRepository extends EntityRepository{
    public function insertCedis($orderId,$cedisId)
    {
        $order= $this->_em->getReference(CoreOrders::class, $orderId);
        $cedis= $this->_em->getReference(CoreCedis::class, $cedisId);
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
