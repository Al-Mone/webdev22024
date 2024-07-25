<?php

// app/Models/Address.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['street', 'suite', 'city', 'zipcode', 'geo_lat', 'geo_lng'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
