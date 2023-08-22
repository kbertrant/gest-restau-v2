<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    public $table = "factures";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fac_num',
        'fac_type',
        'pay_mode',
        'fac_ttval',
        'fac_reste',
        'fac_tva',
        'pay_date',
        'fac_etat',
        'cmd_id',
        'site_id',
        'user_id',
        'idcl',
    ];
}
