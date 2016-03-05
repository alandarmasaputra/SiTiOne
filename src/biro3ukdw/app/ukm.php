<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ukm extends Model
{
    public function content(){
    	return $this->hasMany("App\ukm_content");
    }
}
