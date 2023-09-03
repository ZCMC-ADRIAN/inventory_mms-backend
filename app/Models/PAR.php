<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PAR extends Model
{
    use HasFactory;
    protected $table = 'par';
    protected $primaryKey = 'id';
    protected $fillable = ['Fk_person_ID', 'par_number'];
    public $timestamps = false;
}
