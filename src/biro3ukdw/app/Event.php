<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EventContent;
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
        EventContent::where('event_id', $this->id)
            ->where('type','i')
            ->delete();
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
}
