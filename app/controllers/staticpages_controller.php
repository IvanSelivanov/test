<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 15:30
 */

class StaticPagesController extends BaseController
{
    public function home(){
        session_start();
        $user = User::current();
        session_write_close();
        if ($user)
            View::render('welcome', ['user'=>$user]);
        else
            View::render('login');
    }
}