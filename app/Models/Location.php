<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Associate;

class Location extends Model
{
    use HasFactory;
    
    protected $table = 'location';
    
    protected $fillable = [
        'name',
        'area_code',
    ];

    public $timestamps = true;

   /**
    * The Locations Associate that belong to the Location
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function locationAssociate(): BelongsToMany
   {
       return $this->belongsToMany(Location::class, 'location_associate', 'location_id', 'associate_id');
   }
}
