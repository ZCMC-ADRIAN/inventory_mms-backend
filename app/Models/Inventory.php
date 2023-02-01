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
        'Fk_locationId',
        'Fk_conditionsId',	
        'IAR_num',
        'IAR_date',
        'Delivery_date',
        'Quantity',
        'pack_size',
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
