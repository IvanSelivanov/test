<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 16:01
 */
final class DB {
    private static $instance;
    private $db;
    private function __construct(){
        $this->db = new MySQLi("localhost","root","pribambas","test_app");
        $this->db->set_charset("utf8");
        return $this;
    }

    private function __clone()    { }

    public static function getInstance() {
        if ( is_null(self::$instance) ) {
            self::$instance = new DB;
        }
        return self::$instance;
    }

    public function query($sql){
        return $this->db->query($sql);
    }

    public function success(){
        return $this->db->affected_rows > 0;
    }

    public function insert_id(){
        return $this->db->insert_id;
    }

    public function escape_param($param){
        return $this->db->escape_string(strip_tags($param));
    }

}

?>