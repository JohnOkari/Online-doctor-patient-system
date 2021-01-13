<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
