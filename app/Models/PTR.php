<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PTR extends Model
{
    use HasFactory;

    protected $table = 'ptr';

    protected $primaryKey = 'id';

    protected $fillable = [
        'ptr_num', 
        'system_ptr_num'
    ];

    // public $timestamps = false;
}
