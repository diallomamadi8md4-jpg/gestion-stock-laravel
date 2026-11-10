<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointVente extends Model
{
    protected $table = 'point_ventes';
    protected $primaryKey = 'pve_id';

    protected $fillable = [
        'pve_nom',
        'pve_adresse',
        'latitude',
        'longitude',
        'etat'
    ];

    

    public function produits()
    {
        return $this->hasManyThrough(Produit::class, Stock::class, 'pve_id', 'pro_id', 'pve_id', 'pro_id');
    }

    // Relation avec Reaprovisionnement
    public function reapprovisionnements()
    {
        return $this->hasMany(Reapprovisionnement::class, 'pve_id', 'pve_id');
    }

}
