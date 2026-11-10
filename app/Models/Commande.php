<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $table = 'commandes';
    protected $primaryKey = 'com_id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'pve_id',
        'pro_id',
        'quantite',
        'prix_total',
        'date_commande',
        'date_livraison',
        'etat',
    ];

    /**
     * Relation : une commande appartient à un point de vente
     */
    public function pointVente()
    {
        return $this->belongsTo(PointVente::class, 'pve_id', 'pve_id');
    }

    /**
     * Relation : une commande concerne un produit
     */
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'pro_id', 'pro_id');
    }
}
