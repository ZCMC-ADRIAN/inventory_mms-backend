<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PO extends Model
{
    use HasFactory;
    protected $table = 'po_number';
    protected $primaryKey = 'Pk_poId';
    protected $fillable = ['po_number'];
    public $timestamps = false;
}
