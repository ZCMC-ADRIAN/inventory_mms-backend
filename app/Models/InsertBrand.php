<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertBrand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $primaryKey = 'Pk_brandId';
    protected $fillable = ['brand_name'];
    public $timestamps = false;
}
