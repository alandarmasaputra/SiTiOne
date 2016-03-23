<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\EventContent;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use Input;
use Session;
use Intervention\Image\Facades\Image as Intervention;
use Image;
use App\AppUtility;

class EventController extends Controller
{
    public function index(){
        $events = Event::get();
        return view('event.index',[
            'events'=>$events
        ]);

    }

    public function create(){
    	
    	return view('event.new');
    	 	
    }
    public function edit($id){
           	$event = Event::where('id',$id)->first();
            return view('event.edit', compact('event'));
    }

     public function detail($id){
            $event = Event::where('id',$id)->first();
        return view('event.detail',[
            'event' => $event
        ]);
     		
    }
    public function submit_new(Request $request){
    	$input = $request->all();
        
        //Validasi required input
        $event_name = trim($input['title']);
        
        $errors = array();
        if(!isset($event_name) || $event_name==''){
            $errors[] = "Nama Event harus diisi";
            
        }
        else{
            $newEvent = Event::where('name',$event_name)->first();
            
            if($newEvent!=null){
                $errors[] = "Nama Event sudah ada";
            }
            
        }
        
        //Kalau error redirect kembali
        if(count($errors)>0){
            return back()->withErrors($errors);
        }
    
        $errors = array();
        
        //Save Header
        $newEvent = new Event();
        $newEvent->name = $event_name;
        
        //check if header picture exist
        if($request->hasFile('header-pic')){
            try{
                $file = $request->file('header-pic');

                //make image
                $image = Intervention::make($file);

                //make filename
                $extension = AppUtility::image_mime_to_extension($image->mime()); 
                $filename = 'event_';
                $filename .= AppUtility::get_random_name('');
                $filename .= $extension;

                //compress image
                $image = AppUtility::compress_image($image);

                //Save Image filename
                $newUkm->header_pic = $filename;

                //Save Image
                AppUtility::save_image($filename,$image);
            }catch(\Exception $e){
                        echo $e;
                $errors[] = "Terjadi kesalahan saat mengupload gambar.";
            }
        }
        
        $newUkm->save();
        $newUkm = UKM::where('name',$ukm_name)->first();
        
        
        //Make Contents
        $content_id = 0;
        while(true){
            if(isset($input['type-'.$content_id])){
                //New Content
                $newUkmContent = new UkmContent();
                $newUkmContent->ukm_id = $newUkm->id;
                
                //Check Isi Content
                if($input['type-'.$content_id]=="text"){
                    //Set Type Content
                    $newUkmContent->type = 's';
                    
                    
                    $newUkmContent->content = $input['paragraph-'.$content_id];
                }
                else if($input['type-'.$content_id]=="image"){
                    //Set Type Content
                    if($request->hasFile('img-'.$content_id)){
                        try{

                            $newUkmContent->type = 'i';

                            //ambil file dari 
                            $file = $request->file('img-'.$content_id);
                            //make image
                            $image = Intervention::make($file);

                            //make filename
                            $extension = AppUtility::image_mime_to_extension($image->mime()); 
                            $filename = 'ukm_c_';
                            $filename .= AppUtility::get_random_name('');
                            $filename .= $extension;

                            //extension ga jelas: buang
                            if(trim($extension) == ''){
                                break;
                            }

                            //compress image
                            $image = AppUtility::compress_image($image);

                            //Save Image
                            AppUtility::save_image($filename,$image);

                            $newUkmContent->content = $filename;
                        }catch(\Exception $e){
                            echo $e;
                            $errors[] = "Terjadi kesalahan saat mengupload gambar.";
                        }
                    }
                    
                }
                
                //Save Content
                $newUkmContent->save();
            }
            else{
                break;
            }
            
            $content_id++;
        }
        
        
        // Testing Materials
        /*
            echo "<pre>".json_encode($input,JSON_PRETTY_PRINT)."</pre>";
            echo "<pre>";
            print_r($input);
            echo "</pre>";
        */
        
        
        $successMessage = 'UKM berhasil terdaftar';
        return back()
            ->with('successMessage',$successMessage)
            ->withErrors($errors);
    }

    public function update(Request $request, $id){
    	$event = Event::find($id);
        $event->kategori = $request->input('kategori');
    	$event->sumber = $request->input('sumber');
    	$event->header_pic = $request->input('header_pic');
    	$event->tempat = $request->input('tempat');
    	$event->event_date = $request->input('event_date');
    	$event->save();
        return redirect('/event/edit/'.$id);
    }
}
