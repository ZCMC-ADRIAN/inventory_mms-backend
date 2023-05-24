<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertICSSeries extends Model
{
    use HasFactory;
    protected $table = 'ics_series';
    protected $primaryKey = 'Pk_icsId';
    protected $fillable = ['series'];
    public $timestamps = false;
}
