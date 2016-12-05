<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Checkout\Validator;

/**
 * Description of Cartempty
 *
 * @author dev
 */
class Cartempty {
    
    protected  $cart;
    
    public function __construct($cart) 
    {
        $this->cart = $cart;
    }
    
    public function isValid()
    {
        if(count($this->cart)<=0){
           throw new \InvalidArgumentException(
                'Carrito Vacio');              
        }
        return true;
    }
}
