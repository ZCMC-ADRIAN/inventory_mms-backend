<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    
    protected $primaryKey = 'userId';

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public $timestamps=false;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $timestamp = FALSE;

    public function user()
    {
        return $this->HasMany('App\Models\User');
    }

    //Roles Relationship
    public function role()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function hasAnyRoles($roles)
    {
        if($this->role()->wherIn('name', $roles)->first()){
            return true;
        }

        return false;
    }

    public function hasRole($role)
    {
        if($this->role()->where('name', $role)->first()){
            return true;
        }

        return false;
    }

}
