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
        'drf_num',
        'ptr_num',
        'drf_date'
    ];

    public $timestamps = true;

    /**
     * Get all of the comments for the DonationAcquisition
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function series(): HasMany
    {
        return $this->hasMany(Series::class, 'foreign_key', 'local_key');
    }

    /**
     * The DonationAcquisition that belong to the DonationAcquisition
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function DonationAcquisitionSeries(): BelongsToMany
    {
        return $this->belongsToMany(DonationAcquisition::class, 'donation_acquisition_series', 'donation_acquisitions_id', 'series_id');
    }
}
