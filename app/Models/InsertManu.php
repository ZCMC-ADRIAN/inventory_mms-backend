<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertManu extends Model
{
    use HasFactory;
    protected $table = 'manufacturers';
    protected $primaryKey = 'Pk_manuId';
    protected $fillable = ['manu_name'];
    public $timestamps = false;
}
