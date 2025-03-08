<?php
require_once __DIR__ . '/../model/Model.php';

class Country extends Model
{
    protected static $table = 'country';
    public static $id = 'id';
    public static $name = 'name';
    public static $logo_path = 'logo_path';

    public function __construct($id, $name, $code)
    {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

}