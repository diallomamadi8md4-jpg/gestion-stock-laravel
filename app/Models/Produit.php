<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $table = 'produits';
    protected $primaryKey = 'pro_id';
    public $incrementing = true;   // auto-incrément activé
    protected $keyType = 'int';    // type entier

     // Relation avec Stock
    public function stock()
    {
        return $this->hasOne(Stock::class, 'pro_id');
    }

    // Relation avec Vente
    public function ventes()
    {
        return $this->hasMany(Vente::class, 'pro_id');
    }

    // Relation avec Reapprovisionnement
    public function reapprovisionnements()
    {
        return $this->hasMany(Reapprovisionnement::class, 'pro_id', 'pro_id');
    }


    protected $fillable = [
        'pro_nom',
        'categorie',
    ];
}
