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
    use App\Services\SessionData;

    class UsersController extends BaseController
    {
        public function sign_in(){
            $login = DB::getInstance()->escape_param($_POST['login']);
            $user = User::find_by_params(['name' => $login]);
            if ($user->exists){
                $user->sign_in($_POST['password']);
                $this->log->info('User #'.$user->id.' logging in');
            }
            $this->redirect();
        }

        public function sign_out(){
            $user = SessionData::get_instance()->current_user();
            if ($user->exists) {
                $user->session_key=null;
                $user->save();
            }
            SessionData::get_instance()->set_data(['uid'=>null, 'token'=>null]);
            $this->log->info('User #'.$user->id.' logging out');
            $this->redirect();
        }

        // Генерирует пароль для ручного занесения пользователя в БД
        public function generate_hash(){
            echo password_hash('password', PASSWORD_DEFAULT);
        }
    }
}
