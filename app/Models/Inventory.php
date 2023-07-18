<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';
    public $timestamps = false;
    protected $fillable = [
        'Fk_itemId',
        'Fk_conditionsId',
        'Fk_locatmanId',
        'Fk_propertyId',
        'Fk_assoc_relationId',
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
}