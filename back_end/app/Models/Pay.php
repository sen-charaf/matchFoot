<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory ;

    protected $table = 'pays';
    public $timestamps = false;

    protected $fillable = [
        'nationalite'
    ];

    public function joueurs()
    {
        return $this->hasMany(Joueur::class, 'nationalite_id');
    }
}
