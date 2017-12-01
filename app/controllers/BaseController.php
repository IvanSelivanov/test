<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 19:50
 */

namespace App\Controllers{

    class BaseController
    {
        protected $log;

        public function __construct(\Monolog\Logger $logger)
        {
            $this->log = $logger;
        }

        public function redirect($path = '') {
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
            header('Location:'.$host.$path);

        }
    }
}
