<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Fk_locationId



class Associate extends Model
{
    use HasFactory;
    
    protected $table = 'associate';

    protected $primaryKey = 'id';

    protected $fillable = [
        'associate_name'
    ];

    // public $timestamps = false;

    public function type()
    {
        return $this->belongsToMany('App\Models\Location', 'FK_associate_id', 'FK_location_id')->withPivot('FK_associate_id');
    }
}