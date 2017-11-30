<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 18:24
 */

class ErrorsController extends BaseController
{
    function e404(){
        View::render('404');
    }
}