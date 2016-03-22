<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UkmContent;

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
        UkmContent::where('ukm_id', $this->id)
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
