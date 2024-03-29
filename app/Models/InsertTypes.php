<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertTypes extends Model
{
    use HasFactory;
    protected $table = 'types';
    protected $primaryKey = 'Pk_typeId';
    protected $fillable = ['type_name'];
    public $timestamps = false;
}
