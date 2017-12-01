<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 18:05
 */

namespace App\Views{

    class View
    {

        public static function render($view, $data = null)
        {

            if(is_array($data)) {

                // преобразуем элементы массива в переменные
                extract($data);
            }

            include 'app/views/'.$view.'.php';
        }
    }
}

