<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 17:23
 */

namespace App\Models {

    use App\Services\SessionData;

    class User extends BaseModel
    {
        protected static $table = 'users';

        public function check_password($pass)
        {
            return password_verify($pass, $this->data['password']);
        }

        public function sign_in($pass)
        {
            if ($this->check_password($pass)) {
                $token = bin2hex(random_bytes(30)); // php >= 7.0
                $this->data['session_key'] = $token;
                $this->save();
                SessionData::get_instance()->set_data(['uid' => $this->data['id'],
                                                        'key' => $token]);
                 return true;
            } else return false;
        }

        public static function current()
        {
            if (!isset($_SESSION['uid'])) return false;
            $user = self::find($_SESSION['uid']);
            if ($user->session_key == $_SESSION['key']) return $user;
            return false;
        }

        public function account(): Account
        {
            $account = Account::find($this->data['account_id']);
            return $account;
        }
    }
}