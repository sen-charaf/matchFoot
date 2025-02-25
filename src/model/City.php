<?php
require_once __DIR__ . '/../database/connectDB.php';

class City
{

    use DbConnection;

    private static $table = 'villes';

    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->$id = $id;
        $this->$name = $name;
    }

    
}
