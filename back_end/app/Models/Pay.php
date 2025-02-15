<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $table = 'pays';
    protected $timestamps = false;
    protected $fillable = [
        'nationalite'
    ];

    public function joueurs()
    {
        return $this->hasMany(Joueur::class, 'nationalite_id');
    }
}
