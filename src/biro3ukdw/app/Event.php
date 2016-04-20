<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EventContent;
use App\Ukm;
class Event extends Model
{
    public function content(){
        return $this->hasMany('App\EventContent');
    }
    public function clear(){
        //Clear paragraph content
        EventContent::where('event_id', $this->id)
            ->where('type','s')
            ->delete();
		$imagescontent = EventContent::where('event_id', $this->id)
							->where('type','i')
							->get();
        EventContent::where('event_id', $this->id)
            ->where('type','i')
            ->delete();
		return $imagescontent;
        /*
        $ukm_contents = UkmContent::where('ukm_id', $this->id)
                                ->where('type','i')
                                ->get();
        foreach($ukm_contents as $content){
            if(File::exists(storage_path()."\\app\\".$content)){
                File::delete(storage_path()."\\app\\".$content);
            }
        }*/
    }
	
	public function otherEvents(){
		return Event::where('id','<>',$this->id)->get();
	}
	
	public function sumberlink(){
		$sumberlink = Ukm::where('name','like',$this->sumber)->first();
		if($sumberlink){
			return "/ukm/".$sumberlink->id;
		}
		else{
			return false;
		}
	}
}
