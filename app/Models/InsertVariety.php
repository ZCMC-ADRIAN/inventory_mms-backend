<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertVariety extends Model
{
    use HasFactory;
    protected $table = 'variety';
    protected $primaryKey = 'Pk_varietyId';
    protected $fillable = ['variety/color'];
    public $timestamps = false;
}
