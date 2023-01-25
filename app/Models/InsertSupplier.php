<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertSupplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $primaryKey = 'Pk_supplierId';
    protected $fillable = ['supplier', 'mode'];
    public $timestamps = false;
}
