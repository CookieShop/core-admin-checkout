<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Admin\Checkout;

use Adteam\Core\Admin\Checkout\Validator\Balance;
use Adteam\Core\Admin\Checkout\Validator\Cartempty;

/**
 * Description of Validator
 *
 * @author dev
 */
class Validator 
{
    /**
     *
     * @var type 
     */
    protected $identity;
    
    /**
     *
     * @var type 
     */
    protected $cart;
    
    /**
     *
     * @var type 
     */
    protected $balance;
    
    /**
     * 
     * @param array $params
     */
    public function __construct($params) {
        if(is_array($params)){
            $this->identity = $params['identity'];
            $this->cart = $params['cart'];
            $this->balance = $params['balance'];
        }
    }
    
    /**
     * 
     * @return boolean
     */
    public function isValid()
    {
        $isValid = false;
        if($this->balanceValidate()&&$this->cartemptyValidate()){
            $isValid = true;
        }
        return $isValid;
    }
    
    /**
     * 
     * @return boolean
     */
    public function balanceValidate()
    {
        $balance =  new Balance($this->cart,$this->balance);
        return $balance->isValid();
    }
    
    /**
     * 
     * @return boolean
     */
    public function cartemptyValidate()
    {
        $cartempty = new Cartempty($this->cart);
        return $cartempty->isValid();
    }

}    
