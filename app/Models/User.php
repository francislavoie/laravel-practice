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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_roles_id' => 'integer',
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

    public function isAdmin()
    {
        return $this->user_roles_id === UserRole::ADMIN;
    }

    public function isPublisher()
    {
        return $this->user_roles_id === UserRole::PUBLISHER;
    }

    public function isPublicUser()
    {
        return $this->user_roles_id === UserRole::PUBLIC_USER;
    }
}
