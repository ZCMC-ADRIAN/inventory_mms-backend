<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundCluster extends Model
{
    use HasFactory;
    
    protected $table = 'fund_clusters';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fund_cluster_name'
    ];

    // public $timestamps = false;
}
