<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 20:50
 */

namespace App\Models{

    class Account extends BaseModel
    {
        CONST DEFAULT_MULTIPLIER = 100;
        CONST BTC_MULTIPLIER = 100000000;
        protected static $table = 'accounts';
        protected $multiplier;

         public function withdraw($amount){
            $amount = intVal(round($amount * $this->get_multiplier(), 0));
            $this->data['amount'] -= $amount;
            if ($this->data['amount']>=0) {
//                sleep(10);
                $this->save();
                return true;
            }
            return false;
        }

        protected function get_multiplier()
        {
            if ($this->data['currency']=='BTC')
                $multiplier = self::BTC_MULTIPLIER;
            else
                $multiplier = self::DEFAULT_MULTIPLIER;
            return $multiplier;
        }

        public function get_amount(){
             if ($this->data['amount']!=0) return $this->data['amount']/$this->get_multiplier();
             else return $this->data['amount'];
        }
    }
}
