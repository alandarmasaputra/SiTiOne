<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    public function content(){
    	return $this->hasMany("App\beasiswa_content");
    }
    protected $table = 'beasiswas';

	
    protected $fillable = [
    'id', 
    'header_pic',
    ];
}
