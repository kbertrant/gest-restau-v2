<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmdDetails extends Model
{
    use HasFactory;
    public $table = "detailcommandes";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'quantite',
        'prod_id',
        'com_id',
    ];
}
