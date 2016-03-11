<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function content(){
        return $this->hasMany('App\EventContent');
    }
}
