<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 15:58
 */

namespace App\Models {

    use \App\Services\DB as DB;

    class BaseModel
    {
        protected
        static $table = '';
        public $exists = false;
        protected
            $data = array();

        public function __construct($params = array()) {
            foreach ($params as $key => $value)
                $this->data[$key] = $value;
            return $this;
        }

        public function __get($name) {
            return $this->data[$name];
        }

        public function __set($name, $value)
        {
            $this->data[$name] = $value;
        }

        public static function find($id) {
            $query = "SELECT * FROM ". static::$table ." WHERE id = $id;";
            $result = DB::getInstance()->query($query);
            if (DB::getInstance()->success()) {
                $i = new static($result->fetch_assoc());
                $i->exists = true;
                return $i;
            }
            return new static();
        }

        public static function find_by_params($params = array()) {
            $query_array = array();
            foreach ($params as $key => $value) {
                $query_array[] = "`$key` = '".$value."'";
            }
            $query_string = join(' AND ', $query_array);
            $query = "SELECT id FROM ".static::$table." WHERE $query_string";
            $result = DB::getInstance()->query($query);
            $item = new static();
            if (DB::getInstance()->success()){
                if ($i = $result->fetch_row()) {
                    $item = static::find($i[0]);
                }
            }
            return $item;
        }

        public function save() {
            $assignment_string = "";
            foreach ($this->data as $key => $value)
                $assignment_string .= " `".$key."` = '".$value."',";
            $assignment_string = substr($assignment_string,0,-1);
            $sql = "INSERT INTO ".static::$table." SET".$assignment_string." ON DUPLICATE KEY UPDATE".$assignment_string;
            DB::getInstance()->query($sql);
            if (DB::getInstance()->insert_id()) $this->data['id'] = DB::getInstance()->insert_id();
        }

    }
}