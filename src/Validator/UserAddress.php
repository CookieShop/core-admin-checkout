<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Checkout\Validator;

/**
 * Description of UserAddress
 *
 * @author dev
 */
class UserAddress {

    protected $config;
    
    protected $data;
    
    public function __construct($data,$configs) {
         $this->config = $configs['checkout.delivery.mode'];
         $this->data = $data;
    }    
    
    public function isValid()
    {
       $isValid = false;
        if($this->config==='user-address'){
            $this->isExist();
            $isValid = true;
        }
        
        if($this->config==='none'||$this->config==='cedis'){
            $isValid = true;
        }
        
        return $isValid;
    }
    
    private function isExist()
    {
        if(!isset($this->data->userAddress)){
               throw new \InvalidArgumentException(
                    'La Direccion es requerida'); 
        }
    }
}
