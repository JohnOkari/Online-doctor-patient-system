<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
