<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItemRelation extends Model
{
    use HasFactory;
    protected $table = 'item_inventory';
    protected $primaryKey = 'id';
    protected $fillable = ['Fk_inventoryId', 'Fk_article_relationId', 'Fk_varietyId', 'Fk_brandId', 'Fk_unitId', 'details2', 'model'];
    public $timestamps = false;

    public function inventory()
    {
        return $this->belongsTo(InventoryItemRelation::class, 'id', 'Fk_inventoryId');
    }
}
