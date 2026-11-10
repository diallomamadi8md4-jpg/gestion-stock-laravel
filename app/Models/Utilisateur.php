<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'utilisateurs';      // nom de la table
    protected $primaryKey = 'uti_id';       // clé primaire
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;             

    protected $fillable = [
        'uti_nom',
        'uti_prenom',
        'uti_email',
        'uti_password',
        'role',
    ];

    protected $hidden = [
        'uti_password',
        'remember_token',
    ];

    

    public function getAuthPassword()
    {
        return $this->uti_password;
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'uti_password' => 'hashed',
        ];
    }
}
