<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    public $table = "produits";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prod_name',
        'prod_type',
        'description',
        'qte_prod',
        'stock_min',
        'prix_unit',
        'cad_id'
    ];
}
