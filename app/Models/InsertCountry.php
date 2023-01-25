<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertCountry extends Model
{
    use HasFactory;
    protected $table = 'countries';
    protected $primaryKey = 'Pk_countryId';
    protected $fillable = ['country'];
    public $timestamps = false;
}
