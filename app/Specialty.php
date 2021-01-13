<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $fillable = ['user_id', 'name', 'hospital', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImage()
    {
        return $this->user()->image;
    }
}
