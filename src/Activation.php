<?php
/**
 * Helper para formatear en json paginador
 * 
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @author Ing. Eduardo Ortiz
 * 
 */
namespace Adteam\Core\Checkout;

use Zend\ServiceManager\ServiceManager;
use Doctrine\ORM\EntityManager;
use Adteam\Core\Checkout\Entity\CoreCheckoutActivationLog;


class Activation{

    /**
     *
     * @var type 
     */
    protected $services;
    
    /**
     *
     * @var type 
     */
    protected $identity;

    /**
     * 
     * @param ServiceManager $services
     */
    public function __construct(ServiceManager $services)
    {
        $this->services = $services;
        $this->identity = $services->get('authentication')
                ->getIdentity()->getAuthenticationIdentity();        
    }
    
    /**
     * verifica activacion
     * 
     * @return type
     */
    public function hasActivation()
    {
        $em = $this->services->get(EntityManager::class);
        return $em
                ->getRepository(CoreCheckoutActivationLog::class)->fetchLast();        
    }
    
    /**
     * crea por post log
     * 
     * @param type $data
     * @return type
     */
    public function create($data)
    {
        $em = $this->services->get(EntityManager::class);        
        return $em
                ->getRepository(CoreCheckoutActivationLog::class)
                ->create($data,$this->identity);         
    }
}
