<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TablePosition extends Model
{
    use HasFactory;
    public $table = "table_positions";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'table_name',
        'table_stat',
    ];
}
