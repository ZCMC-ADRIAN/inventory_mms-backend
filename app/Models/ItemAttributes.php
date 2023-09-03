<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PAR;

class ItemAttributes extends Model
{
    use HasFactory;
    protected $table = 'item_attributes';
    protected $primaryKey = 'id';
    protected $fillable = ['Fk_po_ID', 'Fk_par_ID', 'Fk_ics_ID', 'Fk_regular_series', 'Fk_donation_series'];
    public $timestamps = false;

    public function PAR()
    {
        return $this->hasMany(PAR::class);
    }
}
