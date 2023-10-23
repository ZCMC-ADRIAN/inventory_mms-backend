<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regular extends Model
{
    use HasFactory;

    protected $table = 'regulars';

    protected $primaryKey = 'id';

    protected $fillable = [
        'invoice', 
        'po_number',
        'po_date',
        'ors_num',
        'po_conformed',
        'invoice_rec',
        'iar',
        'remarks',
        'FK_fund_cluster_id',
    ];

    // public $timestamps = false;

    
    public function items()
    {
        return $this->belongsToMany('App\Models\Item', 'FK_regular_id', 'FK_item_id')->withPivot('FK_regular_id');
    }

    public function series()
    {
        return $this->belongsToMany('App\Models\Series', 'FK_regular_id', 'FK_series_id')->withPivot('FK_regular_id');
    }
}
