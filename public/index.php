<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 13:55
 */
require '../vendor/autoload.php';
//use Services\DB as DB;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('testApp');
$log->pushHandler(new StreamHandler('../log.txt'));

require_once '../config/route.php';
//require_once 'app/services/db.php';

Route::start($log);