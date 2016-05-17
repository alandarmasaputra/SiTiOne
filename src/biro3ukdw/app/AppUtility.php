<?php

namespace App;
use Intervention\Image\Facades\Image as Intervention;
use Storage;
use File;
use Auth;
use Log as Logger;

class AppUtility
{
    public static function writeLog($words){   
        $log = new Log;
        $log->user_id = Auth::user()->id;
        $log->username = Auth::user()->username;
        $log->activity = $words;
        $log->save();

    }

    public static function get_random_name($word){
        $name = $word.microtime();
        return AppUtility::base64_url_encode($name);
    }
    
    public static function base64_url_encode($input){
        return strtr(base64_encode($input), '+/=', '-_,');
    }
    
    public static function base64_url_decode($input){
        return base64_decode(strtr($input, '-_,', '+/='));    
    }
    
    public static function get_chaos_number($low,$high){
        $divider = rand($low,$high);
        return rand(rand($low,$divider-1),rand($divider,$high));
    }
    
    public static function image_mime_to_extension($mime){
        if ($mime == 'image/jpeg')
            $extension = '.jpg';
        elseif ($mime == 'image/png')
            $extension = '.png';
        elseif ($mime == 'image/gif')
            $extension = '.gif';
        else
            $extension = '';
        
        return $extension;
    }
    
    public static function compress_image($image){
        $max_width = 1280;
        $max_height = 1024;
        
        if($image->width()>$max_width){
            $image->resize($max_width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        
        if($image->height()>$max_height){
            $image->resize(null, $max_height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        
        return $image;
    }
    
    public static function save_image($filename,$image){
        $image = $image->stream();
        Storage::disk('local')->put($filename, $image->__toString());
    }
	
	public static function delete_image($filename){
		if(File::exists(storage_path()."/app/".$filename)){
			File::delete(storage_path()."/app/".$filename);
		}
	}
	
	public static function unlink_deletables($deletables){   
		foreach($deletables as $key => $value){
			if($value==false){
				AppUtility::delete_image($key);
			}
		}
	}
    
    public static function get_image_data($filename){
		try{
			$image = Intervention::make(storage_path()."/app/".$filename);
			$type = AppUtility::image_mime_to_extension($image->mime());
			$data = 'data:image/png'.';base64,'.base64_encode($image->encode('jpg',50));
			return $data;
		}
		catch(\Exception $e){
			Logger::error($e->getTraceAsString());
			return "";
		}
    }
	
	public static function str_limit($word, $limit){
		if(strlen($word)>$limit){
			return substr($word,0,$limit-3)."...";
		}
		return $word;
	}
}
