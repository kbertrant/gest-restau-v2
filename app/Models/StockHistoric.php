<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockHistoric extends Model
{
    use HasFactory;
    public $table = "stock_historics";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'site_id',
        'prod_id',
        'type_mouvement',
        'qte_deplacee'
    ];
}
