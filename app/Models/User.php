<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

use Hash;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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

    public static function boot()
    {
        parent::boot();

        static::deleting(function($user) {
            if($user->address) $user->address->delete();
        });
    }

    /**
     * Rehash password
     * 
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = Hash::needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    /**
     * Get the user's address.
     */
    public function address()
    {
        return $this->hasOne('App\Models\UserAddress');
    }

    /**
     * Get the user's posts.
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post')->orderBy('published_at', 'desc');
    }

    /**
     * Get the user's posts.
     */
    public function published_posts()
    {
        return $this->hasMany('App\Models\Post')->where('published', true)->orderBy('published_at', 'desc');
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

    public function canPublish()
    {
        return $this->isAdmin() || $this->isPublisher();
    }
}
