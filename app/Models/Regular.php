<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regular extends Model
{
    use HasFactory;

    protected $table = 'regular';

    protected $primaryKey = 'id';

    protected $fillable = [
        'invoice',
        'po_date',
        'ors_number',
        'po_conformed',
        'invoice_record',
        'iar_number'
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
}
