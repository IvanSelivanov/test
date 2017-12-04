<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 15:30
 */
namespace App\Controllers{

    use App\Views\View as View;
    use App\Services\SessionData;

    class StaticPagesController extends BaseController
    {
        public function home(){
            $user = SessionData::get_instance()->current_user();
            if ($user->exists)
                View::render('welcome', ['user'=>$user]);
            else
                View::render('login');
        }
    }
}

