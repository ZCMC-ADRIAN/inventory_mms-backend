<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertUnit extends Model
{
    use HasFactory;
    protected $table = 'units';
    protected $primaryKey = 'Pk_unitId';
    protected $fillable = ['unit'];
    public $timestamps = false;
}
