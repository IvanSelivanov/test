<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 15:03
 */

class Route
{

    static function start($logger)
    {
        $controller_name = 'StaticPages';
        $action_name = 'home';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if ( !empty($routes[1]) )
        {
            $controller_name = $routes[1];
        }

        if ( !empty($routes[2]) )
        {
            $action_name = $routes[2];
        }

        // подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_name).'_controller.php';
        $controller_path = "app/controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            include $controller_path;
        }
        else
        {
            // По хорошему, надо бы выдать что-то информативное,
            // но делать этого сейчас мы, конечно же, не будем
             Route::ErrorPage404();
        }

        $controller_name.="Controller";
        // создаем контроллер
        $controller = new $controller_name($logger);
        $action = $action_name;

        if(method_exists($controller, $action))
        {
            // вызываем действие контроллера
            $controller->$action();
        }
        else
        {
            // здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404();
        }

    }

    static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'errors/e404');
    }

}
