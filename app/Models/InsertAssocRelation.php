<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertAssocRelation extends Model
{
    use HasFactory;
    protected $table = 'assoc_relation';
    protected $primaryKey = 'Pk_assoc_relationId';
    protected $fillable = ['Fk_assocId', 'Fk_icsNumId', 'Fk_parNumId', 'ics_number', 'par_number'];
    public $timestamps = false;

    public function article()
    {
        return $this->belongsTo(InsertArticle::class);
    }
    public function type()
    {
        return $this->belongsTo(InsertTypes::class);
    }
}
