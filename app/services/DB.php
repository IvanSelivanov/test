<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 16:01
 */
namespace App\Services{
    final class DB {
        private static $instance;
        private $db;
        private function __construct(){
            $this->db = new \MySQLi("localhost","root","pribambas","test_app");
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

        //  Так и не понял, почему с транзакциями работает не так, как надо.
        //  Получается, что закрыть запись для чтения можно только при помощи
        //  LOCK TABLES

        public function start_transaction(){
            $this->db->query('LOCK TABLES accounts WRITE');
   //         $this->db->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
  //          $this->db->query('SELECT * FROM accounts WHERE id=1 FOR UPDATE');
 //           $this->db->autocommit(FALSE);
 //           $this->db->query("BEGIN;");
        }

        public function end_transaction(){
           $this->db->query('UNLOCK TABLES');
          //  $this->db->commit();
        }

        public function cancel_transaction(){
            $this->db->rollback();
        }

    }

}