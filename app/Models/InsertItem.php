<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertItem extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $primaryKey = 'Pk_itemId';
    protected $fillable = [
        'Fk_typeId', 'Fk_statusId',
        'Fk_manuId', 'Fk_supplierId',
        'Fk_unitId', 'Fk_varietyId', 'Fk_brandId',

        'Fk_countryId','Fk_sourcemodeId','Fk_itemCategId', 'item_name', 'model', 'details2',

        'other', 'serial', 'warranty', 'acquisition_date',
        'property_no', 'expiration', 'cost', 'fundSource',
        'remarks', 'isStored',
    ];
    public $timestamps = false;
}