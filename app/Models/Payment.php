<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public $table = "payments";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pay_num',
        'pay_amount',
        'pay_mode',
        'pay_reste',
        'pay_stat',
        'cmd_id',
        'site_id',
        'user_id',
        'idcl',
    ];
}
