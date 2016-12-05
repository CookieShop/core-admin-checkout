<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Checkout\Repository;

use Doctrine\ORM\EntityRepository;
use Adteam\Core\Checkout\Entity\OauthUsers;
use Adteam\Core\Checkout\Entity\CoreCheckoutActivationLog;

class CoreCheckoutActivationLogRepository extends EntityRepository
{
   
    /**
     * Fetch all config values
     * 
     * @return array
     */
    public function fetchLast()
    {
       $result = $this->createQueryBuilder('B')
               ->select("B.status as enabled,DATE_FORMAT(B.createdAt,'%d-%m-%Y".
                       " %H:%i:%s') as version")
//        ->select("B.status as enabled,B.createdAt as version")
               ->innerJoin('B.requestedBy', 'R')
               ->orderBy('B.createdAt','DESC')
               ->getQuery()->getResult();
        if(isset($result[0])){
            return $result[0];
        }
           throw new \InvalidArgumentException(
                'Inicializar_canje'); 
    }
    
    /**
     * verifica si esta vacio log 
     * 
     * @return boolean
     */
    private function hasInit()
    {
        $isInit = false;
        $result = $this->createQueryBuilder('B')
           ->select("B.id, B.createdAt, R.id as userId, R.displayName, B.status")
           ->innerJoin('B.requestedBy', 'R')
           ->getQuery()->getResult();  
        if(count($result)<=0){
            $isInit = true;
        }
        return $isInit;
        
    }

    /**
     * 
     * @param type $data
     * @param type $identity
     * @return boolean
     * @throws \InvalidArgumentException
     */
    public function create($data,$identity)
    {
        $user = $this->getUserByUsername($identity['user_id']);
        $enabled = (boolean)$data->enabled;
        if($this->hasInit()){
            if($enabled===TRUE){
                $this->insertLog($user, true);
                return true; 
            }else{
                throw new \InvalidArgumentException('only_true');
            }
        }else{
            $lastcreated = $this->fetchLast();
            if($enabled===$lastcreated['enabled']){
               $activo = $lastcreated['enabled']?'canje activo':'canje cerrado';
               throw new \InvalidArgumentException($activo);                
            }
            $this->insertLog($user, $enabled);
            return $enabled; 
        }
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
    
    /**
     * Inserta log de apertura y cierre
     * de canje
     * 
     * @param type $user
     * @param type $status
     */
    public function insertLog($user,$status)
            
    {
        $currentRepo = $this;
        $this->_em->transactional(
            function ($em) use($status,$user,$currentRepo) {
                $log = new CoreCheckoutActivationLog();
                $UserReference = $em->getReference(
                            OauthUsers::class, $user['id']);
                $log->setRequestedBy($UserReference);
                $log->setStatus($status);
                $em->persist($log);             
                $currentRepo->updateCheckoutEnabled($status);
            }
        );
    }
    
    /**
     * update estatus core config
     * 
     * @param type $status
     * @return type
     */
    private function updateCheckoutEnabled($status)
    {    
        $s = (int)$status;
        $dql ="UPDATE Adteam\Core\Checkout\Entity\CoreConfigs U SET U.value = '"
                . $s."' WHERE U.key like 'checkout.enabled'";
        return $this->_em->createQuery($dql)->getResult();
    }
}