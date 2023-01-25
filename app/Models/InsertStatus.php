<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertStatus extends Model
{
    use HasFactory;
    protected $table = 'status';
    protected $primaryKey = 'Pk_statusId';
    protected $fillable = ['status_name'];
    public $timestamps = false;
}
