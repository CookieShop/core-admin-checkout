<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Adteam\Core\Checkout\Checkout;

use Adteam\Core\Checkout\Entity\CoreConfigs;
use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceManager;
/**
 * Description of Steps
 *
 * @author dev
 */
class Steps {
    
    /**
     *
     * @var type 
     */
    protected $service;
    
    /**
     * 
     * @param ServiceManager $service
     */
    public function __construct(ServiceManager $service) {
        $this->service = $service;
    }

    /**
     * ['none'|'fulfill'] Debe o no llenar encuesta
     * ['user-address' | 'cedis'| 'none'] CEDIS o Direccion del usuario o nada
     * 
     * @return type
     */
    public function getSettings()
    {
        $result = $this->getConfigs();
        return [
            'settings'=>[$result]
        ];
    }
    
    /**
     * 
     * @return type
     */
    public function getConfigs()
    {
        $em = $this->service->get(EntityManager::class);
         return $em->getRepository(CoreConfigs::class)->getConfig();         
    }
}
