<?php
require_once __DIR__ . '/Model.php';

class AdminRole extends Model
{
    protected static $table = 'admin_role';
    public static $id = 'id';
    public static $name = 'name';

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
}