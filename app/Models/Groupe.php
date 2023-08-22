<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;

    public $table = "groupes";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'commande',
        'produit',
        'stock',
        'groupe',
        'user',
        'etat',
        'paiements',
        'delivery',
        'parametres',
        
    ];
}
