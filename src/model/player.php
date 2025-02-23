<?php


namespace player;

use model\Person;

class player extends Person
{
    private int $_idPlayer;
    private float $_poid;
    private float $_taille;
    private string $_foot;
    private string $_photoPath;
    public function __construct(Person $Personne,float $poid,float $taille, $foot, $photoPath)
    {
        $_poid = $poid;
        $_taille = $taille;
        $_foot = $foot;
        $_photoPath = $photoPath;
        parent::__construct($Personne, $_poid, $_taille, $_foot);
    }

    /* methods */

    // CRUD
    public  function addPlayer() : bool
    {
        //  add player to dataBase
        $query = "insert into player(firstName,) values (?, ?, ?, ?, ?)";
        return true;
    }





}