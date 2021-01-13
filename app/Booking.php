<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function data()
    {
        return $this->hasMany(Data::class, 'booking_id');
    }
}
