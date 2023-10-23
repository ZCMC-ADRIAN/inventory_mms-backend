<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    
    protected $table = 'articles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'article_name'
    ];

    // public $timestamps = false;

    public function type()
    {
        return $this->belongsToMany('App\Models\Type', 'FK_article_id', 'FK_type_id')->withPivot('FK_article_id');
    }
}
