<?php

namespace App\Models;
use App\Models\Produit;
use App\Models\PointVente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Stock extends Model
{
    use HasFactory;

    protected $primaryKey = 'sto_id';

    protected $fillable = [
        'pve_id',
        'pro_id',
        'quantite',
        'seuil_minimum',
    ];

    // Relations
    public function Produit()
    {
        return $this->belongsTo(Produit::class, 'pro_id');
    }

    public function PointVente()
    {
        return $this->belongsTo(PointVente::class, 'pve_id');
    }
}

