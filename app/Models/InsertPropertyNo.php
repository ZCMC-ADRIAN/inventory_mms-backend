<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertPropertyNo extends Model
{
    use HasFactory;
    protected $table = 'propertyno';
    protected $primaryKey = 'Pk_propertyId';
    protected $fillable = ['Fk_parId', 'Fk_icsId', 'type'];
    public $timestamps = false;
}
