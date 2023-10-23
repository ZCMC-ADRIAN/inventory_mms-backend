<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IcsNumber extends Model
{
    use HasFactory;

    protected $table = 'ics_numbers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'ics_number',
        'FK_user_id'
    ];

    // public $timestamps = false;
}
