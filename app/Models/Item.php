<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'FK_article_id',
        'FK_type_id',
        'FK_manufacturer_id',
        'FK_supplier_id',
        'FK_unit_id',
        'FK_variety_id',
        'FK_brand_id',
        'FK_country_id',
        'FK_item_category_id',
        'model',
        'details2',
        'accessories',
        'other',
        'warranty',
        'acquisition_date',
        'expiration',
        'fundSource',
        'cost',
        'remarks',
    ];

    // public $timestamps = false;
}
