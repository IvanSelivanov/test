<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 17:23
 */

class user extends BaseModel
{
    protected static $table='users';

    function check_password($pass){
        return password_verify($pass, $this->data['password']);
    }

    function sign_in($pass){
        if ($this->check_password($pass)){
            $token = bin2hex(random_bytes(30)); // php >= 7.0
            $this->data['session_key'] = $token;
            $this->save();
            $_SESSION['uid'] = $this->data['id'];
            $_SESSION['key'] = $token;
            return true;
        }
        else return false;
    }

    static function current(){
        if (!isset($_SESSION['uid'])) return false;
        $user = User::find($_SESSION['uid']);
        if ($user->session_key == $_SESSION['key']) return $user;
        return false;
    }

    function account(){
        return Account::find($this->data['account_id']);
    }
}