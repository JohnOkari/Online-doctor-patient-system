<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";
    protected $fillable = ['user_id', 'name', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
