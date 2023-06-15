<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertPARDetails extends Model
{
    use HasFactory;
    protected $table = 'par_details';
    protected $primaryKey = 'Pk_parDetails';
    protected $fillable = ['drf', 'drf_date', 'iar', 'parRemarks'];
    public $timestamps = false;
}
