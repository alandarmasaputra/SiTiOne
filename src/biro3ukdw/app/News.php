<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model

{

  
	protected $table = 'news';

	public function content(){
		return $this->hasMany('App\news_content');
	}
	
    protected $fillable = [
    'id', 
    'header_pic',
    ];	
}
