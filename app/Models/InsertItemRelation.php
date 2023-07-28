<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertItemRelation extends Model
{
    use HasFactory;
    protected $table = 'item_relation';
    protected $primaryKey = 'Pk_item_relationId';
    protected $fillable = ['Fk_itemId', 'Fk_assocId', 'Fk_icsNumId', 'Fk_parNumId', 'ics_number', 'par_number', 'old_icsNum', 'old_parNum'];
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
