<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name'
    ];

    public $timestamps = ["updated_at"];

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
