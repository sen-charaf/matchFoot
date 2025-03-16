<?php 
require_once __DIR__ . '/Model.php';

class TournamentAdmin extends Model {
    public static $table = 'admin_tournament';

    public static $id = 'id';
    public static $adminId = 'admin_id';
    public static $tournamentId = 'tournament_id';
    public static $date = 'date';



    public function __construct($id, $admin_id, $tournament_id, $date) {
        $this->id = $id;
        $this->admin_id = $admin_id;
        $this->tournament_id = $tournament_id;
        $this->date = $date;
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