<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertICSSeries extends Model
{
    use HasFactory;
    protected $table = 'ics_property_series';
    protected $primaryKey = 'id';
    protected $fillable = ['series'];
    public $timestamps = false;
}
