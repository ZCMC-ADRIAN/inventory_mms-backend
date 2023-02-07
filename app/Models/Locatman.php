<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locatman extends Model
{
    use HasFactory;

    protected $table = 'locat_man';
    public $timestamps = false;
    protected $fillable = [
        'Fk_assocId',
        'Fk_locationId',
    ];

    public function assoc()
    {
        return $this->belongsTo(Associate::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
