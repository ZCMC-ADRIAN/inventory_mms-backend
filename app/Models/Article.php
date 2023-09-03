<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Type;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'name'
    ];

    public $timestamps = false;


    /**
     * The Type that belong to the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function type()
    {
        return $this->belongsToMany(Type::class);
    }

    // public function type()
    // {
    //     return $this->belongsToMany('App\Models\Type');
    // }

}
