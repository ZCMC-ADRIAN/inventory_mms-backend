<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Article;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';

    protected $primaryKey = 'id';

    protected $fillable = [
        'type'
    ];

    public $timestamps = ["created_at"];

    // public function article()
    // {
    //     return $this->belongsToMany('App\Models\Article');
    // }

    /**
     * The roles that belong to the Type
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function article()
    {
        return $this->belongsToMany(Article::class);
    }

}
