<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 15:58
 */

class BaseModel
{
    protected
    static $table = '';
    protected
        $data = array();

    public

    function __construct($params = array()) {
        foreach ($params as $key => $value)
            $this->data[$key] = $value;
        return $this;
    }

    function __get($name) {
        return $this->data[$name];
    }

    function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    static function find($id) {
        $query = "SELECT * FROM ". static::$table ." WHERE id = $id;";
//        echo $query;
        $result = DB::getInstance()->query($query);
//        var_dump($result->fetch_assoc());
        if (DB::getInstance()->success()) return new static($result->fetch_assoc());
        return false;
    }

    static function find_by_params($params = array()) {
        $query_array = array();
        $items = [];
        foreach ($params as $key => $value) {
            $query_array[] = "`$key` = '".$value."'";
        }
        $query_string = join(' AND ', $query_array);
        $query = "SELECT id FROM ".static::$table." WHERE $query_string";
  //      echo $query;
        $result = DB::getInstance()->query($query);
    //    var_dump($result);
        if (DB::getInstance()->success()){
            while ($i = $result->fetch_row()) {
                $items[] = static::find($i[0]);
            }
            return $items;
        }
        return [null];
    }

    static function all() {
        $items = [];
        $query = "SELECT id FROM ".static::$table;
        $result = DB::getInstance()->query($query);
        if (DB::getInstance()->affected_rows >0) {
            while ($i = $result->fetch_row()) {
                $items[] = static::find($i[0]);
            }
            return $items;
        }
        else return false;
    }

    function save() {
        $assignment_string = "";
        foreach ($this->data as $key => $value)
            $assignment_string .= " `".$key."` = '".$value."',";
        $assignment_string = substr($assignment_string,0,-1);
        $sql = "INSERT INTO ".static::$table." SET".$assignment_string." ON DUPLICATE KEY UPDATE".$assignment_string;
        DB::getInstance()->query($sql);
//        if (static::$debug)
//       echo $sql;
        if (DB::getInstance()->insert_id()) $this->data['id'] = DB::getInstance()->insert_id();
    }

    function update($params = array()) {
        foreach ($params as $key => $value) {
            $this->data[$key] = $value;
        }
    }

    function get_data() {
        return $this->data;
    }

    function image() {
        if ($this->data['image']){
            if (strpos($this->data['image'], ".")===false)
                return $this->data['image'].".jpg";
            else return $this->data['image'];
        }
        else return null;
    }

    function to_a() {
        return $this->get_data();
    }
}