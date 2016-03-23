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
        $event_kategori = trim($input['kategori']);
        $event_sumber = trim($input['sumber']);
        $event_tempat = trim($input['tempat']);
        $event_date = trim($input['tanggal']);
        
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
        if(!isset($event_kategori) || $event_kategori==''){
            $errors[] = "Kategori Event harus diisi";
            
        }
        if(!isset($event_sumber) || $event_sumber==''){
            $errors[] = "Sumber Event harus diisi";
            
        }
        if(!isset($event_tempat) || $event_tempat==''){
            $errors[] = "Tempat Event harus diisi";
            
        }
        if(!isset($event_date)){
            $errors[] = "Tanggal Event harus diisi";
        }
        if(strtotime($event_date)==false){
            $errors[] = "Tanggal Event tidak valid";
        }


        //Kalau error redirect kembali
        if(count($errors)>0){
            return back()->withErrors($errors);
        }
    
        $errors = array();
        
        //Save Header
        $newEvent = new Event();
        $newEvent->name = $event_name;
        $newEvent->kategori = $event_kategori;
        $newEvent->sumber = $event_sumber;
        $newEvent->tempat = $event_tempat;
        $newEvent->event_date = strtotime($request->input('tanggal'));

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
                $newEvent->header_pic = $filename;

                //Save Image
                AppUtility::save_image($filename,$image);
            }catch(\Exception $e){
                        echo $e;
                $errors[] = "Terjadi kesalahan saat mengupload gambar.";
            }
        }
        
        $newEvent->save();
        echo "Save!!!!!!!!!!";
        $newEvent = Event::where('name',$event_name)->first();
        
        
        //Make Contents
        $content_id = 0;
        while(true){
            if(isset($input['type-'.$content_id])){
                //New Content
                $newEventContent = new EventContent();
                $newEventContent->event_id = $newEvent->id;
                
                //Check Isi Content
                if($input['type-'.$content_id]=="text"){
                    //Set Type Content
                    $newEventContent->type = 's';
                    
                    
                    $newEventContent->content = $input['paragraph-'.$content_id];
                }
                else if($input['type-'.$content_id]=="image"){
                    //Set Type Content
                    if($request->hasFile('img-'.$content_id)){
                        try{

                            $newEventContent->type = 'i';

                            //ambil file dari 
                            $file = $request->file('img-'.$content_id);
                            //make image
                            $image = Intervention::make($file);

                            //make filename
                            $extension = AppUtility::image_mime_to_extension($image->mime()); 
                            $filename = 'event_c_';
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

                            $newEventContent->content = $filename;
                        }catch(\Exception $e){
                            echo $e;
                            $errors[] = "Terjadi kesalahan saat mengupload gambar.";
                        }
                    }
                    
                }
                
                //Save Content
                $newEventContent->save();
            }
            else{
                break;
            }
            
            $content_id++;
        }
        
        
        // Testing Materials
        
            echo "<pre>".json_encode($input,JSON_PRETTY_PRINT)."</pre>";
            echo "<pre>";
            print_r($input);
            echo "</pre>";
        
        
        
        $successMessage = 'Event berhasil terdaftar';
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
