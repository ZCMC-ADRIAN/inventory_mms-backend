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
        'Fk_article_relationId', 'Fk_statusId',
        'Fk_manuId', 'Fk_supplierId',
        'Fk_unitId', 'Fk_varietyId', 'Fk_brandId',

        'Fk_countryId','Fk_acquisitionId','Fk_itemCategId', 'item_name', 'model', 'details2', 'accessories',

        'other', 'serial', 'warranty', 'acquisition_date',
        'property_no', 'expiration', 'cost',
        'remarks', 'isStored',
    ];

    public function fundcluster()
    {
        return $this->belongsTo(InsertFundCluster::class, 'Fk_fundClusterId', 'Pk_fundClusterId');
    }
    public $timestamps = false;
}