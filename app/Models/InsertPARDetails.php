<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertPARDetails extends Model
{
    use HasFactory;
    protected $table = 'par_details';
    protected $primaryKey = 'Pk_parDetails';
    protected $fillable = ['Fk_fundClusterId', 'invoice','drf', 'drf_date', 'iar', 'parRemarks', 'po_date', 'ors_num', 'po_conformed', 'invoice_rec', 'ptr_num'];
    public $timestamps = false;
}
