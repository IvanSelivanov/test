<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 03.12.17
 * Time: 21:27
 */

namespace App\Services;

use App\Models\User;
class SessionData
{
    protected static $instance;
    protected $user,
        $data = [];

    protected function __construct()
    {
        $this->user = new User();
    }

    public function read(): void {
        session_start();
        if (isset($_SESSION['uid']))
        {
            $user = User::find($_SESSION['uid']);
            if ($user->session_key == $_SESSION['key']) $this->user = $user;
        }
        else
        {
            $this->user = new User();
        }
        session_write_close();
    }

    public function set_data($d = []){
        foreach ($d as $key => $value) {
            $this->data[$key] = $value;
        }
    }

    public function data_set(){
        return !empty($this->data);
    }

    public function write(){
        session_start();
        foreach ($this->data as $key => $value){
            $_SESSION[$key] = $value;
        }
        session_write_close();
    }

    public function current_user(){
        return $this->user;
    }

    public static function get_instance(){
        if ( is_null(self::$instance) ) {
            self::$instance = new SessionData();
        }
        return self::$instance;
    }
}