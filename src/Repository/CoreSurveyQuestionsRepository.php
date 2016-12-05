<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Checkout\Repository;

/**
 * Description of CoreSurveyQuestionsRepository
 *
 * @author dev
 */
use Doctrine\ORM\EntityRepository;
use Adteam\Core\Checkout\Entity\OauthUsers;
use Adteam\Core\Checkout\Entity\CoreSurveyQuestions;

class CoreSurveyQuestionsRepository extends EntityRepository
{
    public function save($params)
    {
        $user= $this->_em->getReference(
                OauthUsers::class, $params['identity']['id']);        
        foreach ($params['data']->answers as $items){
            $coresurveyquestions = new CoreSurveyQuestions();
            foreach ($items as $key=>$value){
                $coresurveyquestions->setUser($user);
                if (method_exists($coresurveyquestions, 'set'.ucfirst($key))) {                
                    $coresurveyquestions->{'set'.ucfirst($key)}($value);
                }
                else{
                    throw new \InvalidArgumentException(
                    'Faltan o sobran campos en Json de Encuesta'); 
                }                
            }
            $this->_em->persist($coresurveyquestions);
            $this->_em->flush();              
        }
    }
    
    
}
