<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuiviObjectif extends Model
{
    protected $table = 'suivi_objectifs';
    protected $primaryKey = 'sob_id';

    protected $fillable = [
        'obc_id',
        'date_suivi',
        'quantite_realisee',
        'valeur_realisee',
        'commentaire',
    ];

    public function objectif()
    {
        return $this->belongsTo(ObjectifCommercial::class, 'obc_id', 'obc_id');
    }
}

