<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventContent extends Model
{
    //
    function event(){
        return $this->belongsTo('App\Event');
    }
}
