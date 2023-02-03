<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Fk_locationId



class Associate extends Model
{
    use HasFactory;
    protected $table = 'associate';
    public $timestamps = false;
    protected $fillable = [
        'person_name',
        'Fk_locationId'
    ];
}