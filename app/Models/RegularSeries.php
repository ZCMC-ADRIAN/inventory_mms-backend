<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegularSeries extends Model
{
    use HasFactory;
    protected $table = 'regular_series';
    protected $primaryKey = 'id';
    protected $fillable = ['Fk_regular_ID', 'Fk_series_ID'];
    public $timestamps = false;
}
