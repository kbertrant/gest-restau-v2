<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cmde extends Model
{
    use HasFactory;
    public $table = "commandes";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'numero',
        'ttval',
        'remise',
        'value_remise',
        'cmd_stat',
        'user_id',
        'site_id',
        'cl_id',
        'table_id',
        'cmd_delivery'
    ];
}
