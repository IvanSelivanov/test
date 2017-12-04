<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 20:49
 */

namespace App\Controllers {

    use \App\Services\DB;
    use \App\Views\View;
    use App\Services\SessionData;

    class AccountController extends BaseController
    {
        public function home()
        {
            $user = SessionData::get_instance()->current_user();
            if (!$user->exists) $this->redirect();
            View::render('account', ['user'=>$user]);
        }

        public function withdraw() {
            $amount = (float) $_POST['amount'];
            $user = SessionData::get_instance()->current_user();
            $result = false;
            DB::getInstance()->start_transaction();
            $a = $user->account();
            if ($a->exists){
                $result = $a->withdraw($amount);
      //          $this->log->info('amount: '. $a->get_amount() );
            }
            DB::getInstance()->end_transaction();
            $this->log->info('Пользователь №'.$user->id.". Снятие $amount.");
            if ($result)
                $this->log->info('Успешно');
            else
                $this->log->info('Недостаточно средств');
            $this->redirect('account');
        }
    }
}
