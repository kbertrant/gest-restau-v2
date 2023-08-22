<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    public $table = "deliveries";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dev_num',
        'dev_fees',
        'dev_stat',
        'dev_address',
        'packaging',
        'cmd_id',
        'site_id',
        'user_id',
        'idcl',
        'pay_id',
        'dev_ttval'
    ];
}
