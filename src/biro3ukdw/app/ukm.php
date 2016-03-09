<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ukm extends Model
{
    public function content(){
    	return $this->hasMany("App\UkmContent");
    }
}
