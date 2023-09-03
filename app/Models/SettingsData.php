<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsData extends Model
{
    use HasFactory;

    protected $table = 'settings_data';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name'
    ];

    public $timestamps = true;
}
