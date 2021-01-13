<?php

namespace App;


use App\Role;
use App\Specialty;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function specialty()
    {
        return $this->hasOne(Specialty::class);
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function getspec($id)
    {
        return $specs = DB::table('specialties')->where('user_id', $id)->get()->first();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'doctor_id');
    }


    public function reviews()
    {
        return $this->hasMany('App\Review', 'doctor_id');
    }


}
