<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    protected $fillable = ["name", "image"];

    public function users () 
    {
        return $this->belongsToMany("App\User", 'cuisine_user');
    }
}
