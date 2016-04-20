<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UkmContent;
use App\Event;

class Ukm extends Model
{
    public function content(){
    	return $this->hasMany("App\UkmContent");
    }
    
    public function clear(){
        //Clear paragraph content
        UkmContent::where('ukm_id', $this->id)
            ->where('type','s')
            ->delete();
		$imagescontent = UkmContent::where('ukm_id', $this->id)
							->where('type','i')
							->get();
		/*
        foreach($imagescontent as $content){
            if(File::exists(storage_path()."\\app\\".$content->content)){
                File::delete(storage_path()."\\app\\".$content->content);
            }
		}*/
		UkmContent::where('ukm_id', $this->id)
            ->where('type','i')
            ->delete();
		
		return $imagescontent;
    }
	
	public function events(){
		return Event::where('sumber','like','%'.$this->name.'%')
			->get();
	}
}
