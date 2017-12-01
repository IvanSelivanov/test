<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 15:30
 */
namespace App\Controllers{

    use App\Models\User as User;
    use App\Views\View as View;

    class StaticPagesController extends BaseController
    {
        public function home(){
            $user = User::current();
            if ($user)
                View::render('welcome', ['user'=>$user]);
            else
                View::render('login');
        }
    }
}

