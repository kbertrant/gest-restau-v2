<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmdHistoric extends Model
{
    use HasFactory;
    public $table = "cmd_historics";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cmd_id',
        'cmd_stat',
        'cmd_desc',
    ];
}
