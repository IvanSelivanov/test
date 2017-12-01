<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 20:49
 */

require_once __DIR__.'/../models/account.php';

class AccountController extends BaseController
{
    public function home()
    {
        session_start();
        $user = User::current();
        session_write_close();
        if (!$user) $this->redirect();
        View::render('account', ['user'=>$user]);
    }

    public function withdraw() {
        session_start();
        $amount = (float) $_POST['amount'];
        $user = User::current();
        $result = $user->account()->withdraw($amount);
        session_write_close();
        $this->log->info('Пользователь №'.$user->id.". Снятие $amount.");
        if ($result)
            $this->log->info('Успешно');
        else
            $this->log->info('Недостаточно средств');
        $this->redirect('account');
    }
}