<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsContent extends Model
{
    function news(){
        return $this->belongsTo('App\News');
    }
}
