<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    use HasFactory;

    protected $table = 'item_categories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'item_category_name',
        'item_category_code'
    ];

    // public $timestamps = false;
}
