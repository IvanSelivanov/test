<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 18:24
 */

namespace App\Controllers {

    use App\Views\View as View;

    class ErrorsController extends BaseController
    {
        public function e404(){
            View::render('404');
        }
    }
}
