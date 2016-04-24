<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\NewsContent;
use File;

class News extends Model
{
  
	public function content(){
    	return $this->hasMany("App\NewsContent");
    }

    


    public function tags(){
        return trim(str_replace('internal','',$this->kategori));
    }
    
    public function clear(){
        NewsContent::where('news_id', $this->id)
            ->where('type','s')
            ->delete();
        $imagescontent = NewsContent::where('news_id', $this->id)
                            ->where('type','i')
                            ->get();
       
        NewsContent::where('news_id', $this->id)
            ->where('type','i')
            ->delete();

        return $imagescontent;
    }
}
    
   

