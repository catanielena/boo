<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'vat_numb', 'business_name', 'slug', 'business_address', 'business_logo', 'business_cover'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cuisines ()
    {
        return $this -> belongsToMany("App\Cuisine", 'cuisine_user');
    }

    public function orders ()
    {
        return $this -> hasMany("App\Order");
    }

    public function foods ()
    {
        return $this-> hasMany("App\Food");
    }
}