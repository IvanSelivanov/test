<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 15:46
 */

namespace App\Controllers{

    use \App\Services\DB as DB;
    use \App\Models\User as User;

    class UsersController extends BaseController
    {
        public function sign_in(){
            $login = DB::getInstance()->escape_param($_POST['login']);
            $user = User::find_by_params(['name' => $login]);
            if ($user->exists){
                $user->sign_in($_POST['password']);
                $this->log->info('User #'.$user->id.' logged in');
            }
            $this->redirect();
        }

        public function sign_out(){
            $user = User::find_by_params(['name' => $_SESSION['uid']]);
            if ($user->exists) {
                $user->session_key=null;
                $user->save();
            }
            unset($_SESSION['uid']);
            unset($_SESSION['token']);
            $this->log->info('User #'.$user->id.' logged out');
            $this->redirect();
        }

        // Генерирует пароль для ручного занесения пользователя в БД
        public function generate_hash(){
            echo password_hash('password', PASSWORD_DEFAULT);
        }
    }
}
