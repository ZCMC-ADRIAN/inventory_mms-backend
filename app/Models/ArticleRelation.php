<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleRelation extends Model
{
    use HasFactory;
    protected $table = 'article_relation';
    public $timestamps = false;
    protected $fillable = [
        'Fk_articleId',
        'Fk_typeId',
    ];
}
