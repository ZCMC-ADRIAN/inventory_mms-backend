<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class ParNumber extends Model
{
    use HasFactory;

    protected $table = 'manufacturers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'par_number'
    ];

    public $timestamps = false;

    /**
     * Get the user associated with the IcsNumber
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'foreign_key', 'local_key');
    }

}
