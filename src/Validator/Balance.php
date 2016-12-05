<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Checkout\Validator;

/**
 * Description of Balance
 *
 * @author dev
 */
class Balance {
    
    protected $cart;
    
    protected $balance;
    
    public function __construct($cart,$balance) {
            $this->cart = $cart;
            $this->balance = $balance;
    }
    
    public function isValid()
    {
        if($this->getTotal()>$this->getAmount()){
           throw new \InvalidArgumentException(
                'No se cuenta con los puntos suficientes');             
        }
        return true;
    }
    
    private function getTotal()
    {
        $total = 0;
        foreach ($this->cart as $item){
            $total += $item['price']*$item['quantity'];
        }
        return $total;
    }
    
    private function getAmount()
    {
        return (int)$this->balance['amount'];
    }
}
