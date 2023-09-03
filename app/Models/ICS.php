<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICS extends Model
{
    use HasFactory;
    protected $table = 'ics';
    protected $primaryKey = 'id';
    protected $fillable = ['Fk_person_ID', 'ics_number'];
    public $timestamps = false;
}
