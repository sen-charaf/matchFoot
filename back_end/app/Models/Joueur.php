<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pay;


class Joueur extends Model
{
    protected $table = 'joueurs';
    protected $timestamps = false;
    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'poid',
        'taill',
        'pied',
        'photo_path'
    ];

    public function nationalite()
    {
        return $this->belongsTo(Pay::class, 'nationalite_id');
    }

}
