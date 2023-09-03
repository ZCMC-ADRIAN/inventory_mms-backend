<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';
    protected $primaryKey = 'Pk_inventoryId';
    public $timestamps = false;
    protected $fillable = [
        'Fk_itemId',
        'Fk_conditionsId',
        'Fk_locatmanId',
        'Fk_propertyId',
        'Fk_item_attributes',
        'Delivery_date',
        'Quantity',
        'property_no',
        'newProperty',
        'serial',
        'barcode',
        'Remarks'
    ];

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function item()
    {
        return $this->belongsTo(InsertItem::class, 'Fk_itemId', 'Pk_itemId');
    }
    
    public function locatMan()
    {
        return $this->belongsTo(LocatMan::class, 'Fk_locatmanId', 'Pk_locatmanId');
    }

    public function inventories()
    {
        return $this->belongsTo(Inventory::class, 'Fk_itemId', 'Pk_itemId');
    }

    public function fundcluster()
    {
        return $this->belongsTo(InsertFundCluster::class, 'Fk_fundClusterId', 'Pk_fundClusterId');
    }
}