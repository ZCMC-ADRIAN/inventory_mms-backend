<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertFundCluster extends Model
{
    use HasFactory;
    protected $table = 'fundcluster';
    protected $primaryKey = 'Pk_fundCluster';
    protected $fillable = ['fundCluster'];
    public $timestamps = false;
}
