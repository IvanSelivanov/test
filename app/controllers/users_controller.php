<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 15:46
 */
class UsersController extends BaseController
{
    public function sign_in(){
        $login = DB::getInstance()->escape_param($_POST['login']);
        $user = User::find_by_params(['name' => $login])[0];
        if ($user){
            session_start();
            $user->sign_in($_POST['password']);
            session_write_close();
            $this->log->info('User #'.$user->id.' logged in');
        }
        $this->redirect();
    }

    public function sign_out(){
        session_start();
        $user = User::find_by_params(['name' => $_SESSION['uid']])[0];
        if ($user) {
            $user->session_key=null;
            $user->save();
        }
        unset($_SESSION['uid']);
        unset($_SESSION['token']);
        session_write_close();
        $this->log->info('User #'.$user->id.' logged out');
        $this->redirect();
    }

    // Генерирует пароль для ручного занесения пользователя в БД
    public function generate_hash(){
        echo password_hash('password', PASSWORD_DEFAULT);
    }
}