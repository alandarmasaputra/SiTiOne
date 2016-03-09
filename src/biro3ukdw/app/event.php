<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    function content(){
        $this->hasMany('App\EventContent');
    }
}
