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
        // 'IAR_num',
        // 'IAR_date',
        'Delivery_date',
        'Quantity',
        'property_no',
        'serial',
        'loose',
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