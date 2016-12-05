<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Checkout\Validator;

class Survey {
    
    protected $survey;
    
    protected $config;
    
    public function __construct($survey,$config) {
        $this->survey = $survey;
        $this->config = (boolean)$config['survey.isMandatory'];
    }
    
    public function isValid()
    {
        $this->hasSurvey();
        $this->isExist();
        return true;
    }
    
    private function hasSurvey()
    {
        if(!is_array($this->survey)&&!is_null($this->survey)){
           throw new \InvalidArgumentException(
                'Formato de encuesta debe ser formado preguntas y respuesta');            
        }
    }
    
    private function isExist()
    {
        if(is_null($this->survey)&&$this->config){
           throw new \InvalidArgumentException(
                'La encuesta es requerida');             
        }
    }
}
