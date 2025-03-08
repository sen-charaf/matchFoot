<?php
require_once __DIR__ . '/../model/Model.php';

class StaffRole extends Model
{
    protected static $table = 'staff_role';
    public static $id = 'id';
    public static $name = 'name';
    public static $description = 'description';

    public function __construct($id, $name)
    {
        $this->$id = $id;
        $this->$name = $name;
    }

   
}