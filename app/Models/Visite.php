<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    protected $primaryKey = 'vis_id';   // car ta clé primaire n’est pas "id"
    protected $table = 'visites';       // nom de la table

    protected $fillable = [
        'uti_id',
        'pve_id',
        'date_planifié',
        'date_effectué',
        'etat',
    ];
}
