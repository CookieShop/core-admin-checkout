<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Checkout\Validator;

class Checkoutenabled
{
    protected $configs;
    
    public function __construct($configs) 
    {
        $this->configs = (boolean)$configs['checkout.enabled'];
    }
    
    public function isValid()
    {
        if(!$this->configs){
           throw new \InvalidArgumentException(
                'Canje deshabilitado');             
        }
        return true;
    }
}
