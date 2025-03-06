<?php 


class Player extends Model{

    protected static $table = 'joueurs';

    private $id;
    private $name;
    private $surname;
    private $birthday;
    private $nationality;
    private $position;
    private $club;
    private $created_at;

    public function __construct($id, $name, $surname, $birthday, $nationality, $position, $club, $created_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->birthday = $birthday;
        $this->nationality = $nationality;
        $this->position = $position;
        $this->club = $club;
        $this->created_at = $created_at;
    }
}