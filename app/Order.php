<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['user_id', 'ui_name', 'ui_delivery_address', 'ui_email', 'ui_phone', 'ui_delivery_info', 'total_price', 'status' ];
    
    public function user() {
        return $this->belongsTo("App\User");
    }

    public function foods () 
    {
        return $this->belongsToMany("App\Food");
    }
}
