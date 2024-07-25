<?php

// app/Models/Company.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'catchPhrase', 'bs'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

