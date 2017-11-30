<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 18:05
 */

class View
{

    static function render($view, $data = null)
    {

        if(is_array($data)) {

            // преобразуем элементы массива в переменные
            extract($data);
        }

        include 'app/views/'.$view.'.php';
    }
}
