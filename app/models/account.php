<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 20:50
 */

class Account extends BaseModel
{
    protected static $table = 'accounts';
    function withdraw($amount){
        if ($amount<=$this->data['amount']) {
            $this->data['amount'] -= $amount;
            $this->save();
        }
    }
}