<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BeasiswaContent;
class Beasiswa extends Model
{
    public function content(){
    	return $this->hasMany('App\BeasiswaContent');
    }
    
	public function isInternal(){
		return strpos($this->kategori,'internal')!==false;
	}
    
	public function isExternal(){
		return strpos($this->kategori,'internal')===false;
	}
	
	public function tags(){
		return trim(str_replace('external','',str_replace('internal','',$this->kategori)));
	}
	
	public function clear(){
        BeasiswaContent::where('beasiswa_id', $this->id)
            ->where('type','s')
            ->delete();
		$imagescontent = UkmContent::where('beasiswa_id', $this->id)
							->where('type','i')
							->get();
        foreach($imagescontent as $content){
            if(File::exists(storage_path()."\\app\\".$content->content)){
                File::delete(storage_path()."\\app\\".$content->content);
            }
		}
		BeasiswaContent::where('beasiswa_id', $this->id)
            ->where('type','i')
            ->delete();
	}
}
