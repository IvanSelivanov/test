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
        protected static $table = 'accounts';
        public function withdraw($amount){
            if ($amount<=$this->data['amount']) {
                $this->data['amount'] -= $amount;
                $this->save();
                return true;
            }
            return false;
        }
    }
}
