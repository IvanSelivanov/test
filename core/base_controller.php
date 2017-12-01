<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 19:50
 */

class BaseController
{
    protected $log;

    function __construct($logger)
    {
        $this->log = $logger;
    }

    function redirect($path = '') {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('Location:'.$host.$path);

    }
}