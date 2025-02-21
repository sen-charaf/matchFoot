<?php
require_once __DIR__ . '/../database/connectDB.php';

class Admin extends User{
    private static $table = 'admins';

    private $first_name;
    private $last_name;
    private $birth_date;
    private $phone_number;
    private $role;

    
}