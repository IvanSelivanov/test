<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 20:49
 */

namespace App\Controllers {

    use \App\Services\DB as DB;
    use \App\Models\User as User;
    use \App\Views\View as View;

    class AccountController extends BaseController
    {
        public function home()
        {
            $user = User::current();
            if (!$user->exists) $this->redirect();
            View::render('account', ['user'=>$user]);
        }

        public function withdraw() {
            $amount = (float) $_POST['amount'];
            $user = User::current();
            $result = false;
            try {
                DB::getInstance()->start_transaction();
                $a = $user->account();
                if ($a->exists){
                    $result = $a->withdraw($amount);
                }
                DB::getInstance()->end_transaction();
            } catch (\Exception $e){
                DB::getInstance()->cancel_transaction();
            }
            $this->log->info('Пользователь №'.$user->id.". Снятие $amount.");
            if ($result)
                $this->log->info('Успешно');
            else
                $this->log->info('Недостаточно средств');
            $this->redirect('account');
        }
    }
}
