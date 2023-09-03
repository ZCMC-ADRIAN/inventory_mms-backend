<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationSeries extends Model
{
    use HasFactory;
    protected $table = 'donation_series';
    protected $primaryKey = 'id';
    protected $fillable = ['Fk_donation_ID', 'Fk_series_ID'];
    public $timestamps = false;
}
