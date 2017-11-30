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
    function home()
    {
        session_start();
        $user = User::current();
        session_write_close();
        if (!$user) $this->redirect();
        View::render('account', ['user'=>$user]);
    }

    function withdraw() {
        session_start();
        $user = User::current();
        $user->account()->withdraw($_POST['amount']);
        session_write_close();
        $this->redirect('account');
    }
}