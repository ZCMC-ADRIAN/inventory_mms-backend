<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertPeripherals extends Model
{
    use HasFactory;
    protected $table = 'peripherals';
    protected $primaryKey = 'Pk_peripheralId';
    protected $fillable = ['Fk_itemId', 'Fk_article_relationId', 'Fk_varietyId', 'Fk_brandId', 'details', 'serial', 'property_no'];
    public $timestamps = false;
}
