<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertICSDetails extends Model
{
    use HasFactory;
    protected $table = 'ics_details';
    protected $primaryKey = 'Pk_icsDetails';
    protected $fillable = ['po_number', 'po_date', 'invoice', 'invoiceDate', 'ors', 'icsRemarks'];
    public $timestamps = false;
}