<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 13:55
 */
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('log/log.txt', Logger::NOTICE));

require_once 'config/route.php';
require_once 'app/services/db.php';
require_once 'core/base_model.php';
require_once 'core/base_view.php';
require_once 'core/base_controller.php';
require_once 'app/models/user.php';

Route::start($log);