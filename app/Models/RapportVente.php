<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RapportVente extends Model
{
    use HasFactory;

    protected $primaryKey = 'rve_id'; // clé primaire personnalisée
    protected $table = 'rapport_ventes'; // nom de la table

    protected $fillable = [
        'pve_id',
        'date_debut',
        'date_fin',
        'total',
        'nb_ventes',
        'quantite_totale',
        'statut',
    ];

    // Relation avec PointVente
    public function pointVente()
    {
        return $this->belongsTo(PointVente::class, 'pve_id', 'pve_id');
    }
}
