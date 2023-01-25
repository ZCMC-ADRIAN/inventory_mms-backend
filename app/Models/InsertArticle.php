<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertArticle extends Model
{
    use HasFactory;
    protected $table = 'articles';
    protected $primaryKey = 'Pk_articleId';
    protected $fillable = ['article_name'];
    public $timestamps = false;
}
