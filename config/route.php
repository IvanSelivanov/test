<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 15:03
 */

class Route
{

    public static function start($logger)
    {
        $action = 'home';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if ( empty($routes[1]) ) {
            $controller = new \App\Controllers\StaticPagesController($logger);
        }
        else
        {
            switch ($routes[1]) {
                case 'account':
                    $controller =  new App\Controllers\AccountController($logger);
                    break;
                case 'errors':
                    $controller = new \App\Controllers\ErrorsController($logger);
                    break;
                case 'users':
                    $controller = new \App\Controllers\UsersController($logger);
                    break;
                default:
                    $controller = null;
                    Route::ErrorPage404();
            }
         }

        if ( !empty($routes[2]) )
        {
            $action = $routes[2];
        }

        if(method_exists($controller, $action))
        {
            session_start();
            // вызываем действие контроллера
            $controller->$action();
            session_write_close();
        }
        else
        {
            // здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404();
        }

    }

    public static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'errors/e404');
    }

}
