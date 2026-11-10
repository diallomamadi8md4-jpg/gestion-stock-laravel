<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $primaryKey = 'ven_id';
    protected $fillable = ['pve_id', 'pro_id', 'quantite', 'prix_unitaire', 'prix_total'];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'pro_id');
    }

    public function pointVente()
    {
        return $this->belongsTo(PointVente::class, 'pve_id');
    }
}
