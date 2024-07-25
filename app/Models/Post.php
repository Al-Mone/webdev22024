<?php

// app/Models/Post.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'userId'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
