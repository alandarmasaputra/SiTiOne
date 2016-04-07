<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\NewsContent;

class News extends Model
{
  
	public function content(){
    	return $this->hasMany("App\NewsContent");
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
        NewsContent::where('news_id', $this->id)
            ->where('type','s')
            ->delete();
        $imagescontent = NewsContent::where('news_id', $this->id)
                            ->where('type','i')
                            ->get();
        foreach($imagescontent as $content){
            if(File::exists(storage_path()."\\app\\".$content->content)){
                File::delete(storage_path()."\\app\\".$content->content);
            }
        }
        NewsContent::where('news_id', $this->id)
            ->where('type','i')
            ->delete();
    }
}
    
   

