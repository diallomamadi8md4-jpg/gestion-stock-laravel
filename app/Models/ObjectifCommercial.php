<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectifCommercial extends Model
{
    use HasFactory;

    protected $table = 'objectifs_commercials';
    protected $primaryKey = 'obc_id';

    protected $fillable = [
        'uti_id',
        'pro_id',
        'type',
        'quantite',
        'valeur_cible',
        'date_debut',
        'date_fin',
        'etat',
    ];

    // Relations
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'uti_id', 'uti_id');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'pro_id', 'pro_id');
    }
}
