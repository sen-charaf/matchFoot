<?php
require_once __DIR__ . '/Model.php';

class Club extends Model
{

    

    protected static $table = 'equipes';

    private $id;
    private $name;
    private $nickname;
    private $logo;
    private $logo_path;
    private $trainer;
    private $stadium;
    private $founded_at;
    private $created_at;

    

    public function __construct($id, $name, $nickname, $founded_at, $created_at, $logo = null, $logo_path = null, $trainer = null, $stadium = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->nickname = $nickname;
        $this->founded_at = $founded_at;
        $this->created_at = $created_at;
        $this->logo = $logo;
        $this->logo_path = $logo_path;
        $this->trainer = $trainer;
        $this->stadium = $stadium;
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }
}
