<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'user_roles_id', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the user's address.
     */
    public function address()
    {
        return $this->hasOne('App\Models\UserAddress');
    }

    /**
     * Get the user's role.
     */
    public function role()
    {
        return $this->belongsTo('App\Models\UserRole', 'user_roles_id');
    }
}
