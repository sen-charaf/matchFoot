<?php
require_once __DIR__ . '/Model.php';


class Tournament extends Model
{
    public static $table = 'tournament';

    public static $id="id";
    public static $name="name";
    public static $teamNbr="team_count";
    public static $roundNbr="round_count";
    public static $logoPath="logo_path";

    public function __construct($id, $name,$teamNbr,$roundNbr,$logoPath)
    {
        $this->id = $id;
        $this->name = $name;
        $this->teamNbr = $teamNbr;
        $this->roundNbr = $roundNbr;
        $this->logoPath = $logoPath;

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