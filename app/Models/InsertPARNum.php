<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertPARNum extends Model
{
    use HasFactory;
    protected $table = 'par_no';
    protected $primaryKey = 'Pk_parNumId';
    protected $fillable = ['series'];
    public $timestamps = false;
}
