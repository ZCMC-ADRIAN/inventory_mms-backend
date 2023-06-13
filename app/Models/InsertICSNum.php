<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertICSNum extends Model
{
    use HasFactory;
    protected $table = 'ics_no';
    protected $primaryKey = 'Pk_icsNumId';
    protected $fillable = ['series'];
    public $timestamps = false;
}
