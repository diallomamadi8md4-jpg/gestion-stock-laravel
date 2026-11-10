<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prospection extends Model
{
    protected $primaryKey = 'prp_id';   // ta clé primaire
    protected $table = 'prospections';  // nom de la table

    protected $fillable = [
        'uti_id',
        'npvp',
        'adresse',
        'telephone',
        'statut',
        'remarques',
    ];
}
