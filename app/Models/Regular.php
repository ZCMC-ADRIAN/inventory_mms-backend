<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regular extends Model
{
    use HasFactory;
    protected $table = 'regular';
    protected $primaryKey = 'id';
    protected $fillable = ['Fk_fundClusterId', 'invoice', 'po_date', 'ors_num', 'po_conformed', 'invoice_rec', 'iar_num'];
    public $timestamps = false;
}
