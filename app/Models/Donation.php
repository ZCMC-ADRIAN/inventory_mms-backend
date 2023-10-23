<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    
    protected $table = 'donation';

    protected $primaryKey = 'id';

    protected $fillable = [
        'FK_drf_id', 
        'FK_ptr_id'
    ];

    // public $timestamps = false;

      
    public function items()
    {
        return $this->belongsToMany('App\Models\Item', 'FK_donation_id', 'FK_item_id')->withPivot('FK_donation_id');
    }

    public function series()
    {
        return $this->belongsToMany('App\Models\Series', 'FK_donation_id', 'FK_series_id')->withPivot('FK_donation_id');
    }
}
