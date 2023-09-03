<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    protected $table = 'donation';
    protected $primaryKey = 'id';
    protected $fillable = ['drf_num', 'ptr_num', 'drf_date'];
    public $timestamps = false;
}
