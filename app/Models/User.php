<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'password',
        'name',
        'email',
        'phone',
        'website',
        'bio',
        'profile_photo',
        'cover_photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'userId');
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }
}
