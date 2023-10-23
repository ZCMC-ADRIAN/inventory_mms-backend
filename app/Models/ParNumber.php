<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParNumber extends Model
{
    use HasFactory;

    protected $table = 'par_numbers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'par_number',
        'FK_user_id'
    ];

    // public $timestamps = false;
}
