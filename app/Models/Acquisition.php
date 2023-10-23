<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acquisition extends Model
{
    use HasFactory;

    protected $table = 'acquisitions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'acquisition_type'
    ];

    // public $timestamps = false;
}
