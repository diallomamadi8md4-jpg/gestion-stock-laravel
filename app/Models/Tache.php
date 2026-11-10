<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    protected $primaryKey = 'tac_id';   // clé primaire
    protected $table = 'taches';        // nom de la table

    protected $fillable = [
        'uti_id',
        'description',
        'date_debut',
        'date_fin',
        'etat',
    ];
}
