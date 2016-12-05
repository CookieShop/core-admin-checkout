<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Checkout;

use Adteam\Core\Checkout\Validator\Balance;
use Adteam\Core\Checkout\Validator\Cartempty;
use Adteam\Core\Checkout\Validator\Checkoutenabled;
use Adteam\Core\Checkout\Validator\Survey;
use Adteam\Core\Checkout\Validator\UserAddress;
use Adteam\Core\Checkout\Validator\Cedis;

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
    protected $configs;
    
    /**
     *
     * @var type 
     */
    protected $balance;
    
    /**
     *
     * @var type 
     */
    protected $answers;

    /**
     * 
     * @param array $params
     */
    public function __construct($params) {
        if(is_array($params)){
            $this->identity = $params['identity'];
            $this->cart = $params['cart'];
            $this->configs = $params['configs'];
            $this->balance = $params['balance'];
            $this->answers = $params['survey'];
            $this->data    = $params['data']; 
        }
    }
    
    /**
     * 
     * @return boolean
     */
    public function isValid()
    {
        $isValid = false;
        if($this->balanceValidate()
                &&$this->cartemptyValidate()
                &&$this->checkoutenabledValidate()
                &&$this->surveyValidate() 
                &&$this->useraddressValidator()  
                &&$this->cedisValidator()        
          ){
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
    
    /**
     * 
     * @return boolean
     */
    public function checkoutenabledValidate()
    {
        $checkoutenabled = new Checkoutenabled($this->configs);
        return $checkoutenabled->isValid();
    }
    
    /**
     * 
     * @return boolean
     */
    public function surveyValidate()
    {
        $survey = new Survey($this->answers,$this->configs); 
        return $survey->isValid();
    }
    
    public function useraddressValidator()
    {
        $useradress = new UserAddress($this->data,$this->configs);
        return $useradress->isValid();
    }
    
    public function cedisValidator()
    {
        $cedis = new Cedis($this->data,$this->configs);
        return $cedis->isValid();        
    }

}    
