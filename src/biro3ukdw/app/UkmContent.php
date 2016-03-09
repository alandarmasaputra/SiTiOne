<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UkmContent extends Model
{
    function ukm(){
        return $this->belongsTo('App\Ukm');
    }
}
