<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reapprovisionnement extends Model
{
    use HasFactory;

    protected $primaryKey = 'rea_id'; // clé primaire personnalisée
    protected $table = 'reapprovisionnements';

    protected $fillable = [
        'pve_id',
        'pro_id',
        'quantite',
        'type',
    ];

    // Relations
    public function pointVente()
    {
        return $this->belongsTo(PointVente::class, 'pve_id', 'pve_id');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'pro_id', 'pro_id');
    }
}
