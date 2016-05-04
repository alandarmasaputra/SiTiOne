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
use Carbon\Carbon;
use Auth;

class EventController extends Controller
{
	public $maxTitleLength = 200;
	
    public function index(){
        $events = Event::orderBy('event_date','desc')->get();
        return view('event.index',[
            'events'=>$events
        ]);

    }

    public function create(){
    	if(!Auth::user()){
            $errors = array();
            $errors[] = "Anda memasukkan alamat url yang salah";
            return back()->withErrors($errors);
        }
    	return view('event.new');
    	 	
    }
	
	function getList(Request $request){
		
		try{
			$events = Event::where('name','like','%'.$request->all()['query'].'%')
				->orderBy('id','desc')
				->get();
			return view('event.list',[
				'events'=>$events
			]);
		}
		catch(\Exception $e){
			echo $e;
		}
	}
	
    public function edit($id){
        $event = Event::where('id',$id)->first();
        if($event==null){
            $errors = array();
            $errors[] = "Event yang dituju tidak ditemukan";
            return redirect('/event')->withErrors($errors);
        }
        if(!Auth::user()){
            $errors = array();
            $errors[] = "Anda memasukkan alamat url yang salah";
            return back()->withErrors($errors);
        }
        
        $contents = $event->content();
        return view('event.edit',[
            'event' => $event,
            'event_contents' => $contents
        ]);
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
		if($request->input('tanggal')){
        	$event_date = Carbon::createFromFormat('Y-m-d', $request->input('tanggal'));
		}else{
        	$event_date = null;
		}
        
        $errors = array();
        if(!isset($event_name) || $event_name==''){
            $errors[] = "Nama Event harus diisi";
            
        }
        else{
            $newEvent = Event::where('name',$event_name)->first();
            
            if($newEvent!=null){
                $errors[] = "Nama Event sudah ada";
            }
			
			if(strlen($event_name)>$this->maxTitleLength){
				$errors[] = "Nama Event tidak boleh lebih dari ".$this->maxTitleLength." huruf";
			}
            
        }
        if(!isset($event_sumber) || $event_sumber==''){
            $errors[] = "Sumber Event harus diisi";
            
        }
        if(!isset($event_tempat) || $event_tempat==''){
            $errors[] = "Tempat Event harus diisi";
            
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
        $newEvent->event_date = $event_date;

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
        //echo "Save!!!!!!!!!!";
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
        
            //echo "<pre>".json_encode($input,JSON_PRETTY_PRINT)."</pre>";
            //echo "<pre>";
            //print_r($input);
            //echo "</pre>";
        
        
        
        $successMessage = 'Event berhasil terdaftar';
        AppUtility::writeLog("membuat event baru");
        return back()
          ->with('successMessage',$successMessage)
            ->withErrors($errors);
    }

    public function update(Request $request, $id){
    	$deletables = array();
        $input = $request->all();
                                                       
        $event_name = trim($input['title']);
        $event_kategori = trim($input['kategori']);
        $event_sumber = trim($input['sumber']);
        $event_tempat = trim($input['tempat']);
		if($request->input('tanggal')=="" || $request->input('tanggal')==null){
        	$event_date = null;
		}else{
        	$event_date = Carbon::createFromFormat('Y-m-d', $request->input('tanggal'));
		}

        
        $errors = array();
        if(!isset($event_name) || $event_name==''){
            $errors[] = "Nama Event harus diisi";
        }
        else{
            $newEvent = Event::where('name',$event_name)->where('id','!=',$id)->first();
            
            if($newEvent!=null){
                $errors[] = "Nama Event sudah ada";
            }
			
			if(strlen($event_name)>$this->maxTitleLength){
				$errors[] = "Nama UKM tidak boleh lebih dari ".$this->maxTitleLength." huruf";
			}
        }
        if(!isset($event_sumber) || $event_sumber==''){
            $errors[] = "Sumber Event harus diisi";
            
        }
        if(!isset($event_tempat) || $event_tempat==''){
            $errors[] = "Tempat Event harus diisi";
            
        }
        //if(!isset($event_date)){
         //   $errors[] = "Tanggal Event harus diisi";
        //}
        //if(strtotime($event_date)==false){
         //   $errors[] = "Tanggal Event tidak valid";
        //}

        
        //Kalau error redirect kembali
        if(count($errors)>0){
            return back()->withErrors($errors)->withInput();
        }
        
        $newEvent = Event::where('id',$id)->first();
            
        //Initialization Error
        $errors = array();
        
        //Save Header;
        $newEvent->name = $event_name;
        $newEvent->kategori = $event_kategori;
        $newEvent->sumber = $event_sumber;
        $newEvent->tempat = $event_tempat;
        $newEvent->event_date = $event_date;
        
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
				$deletables[$newEvent->header_pic] = false;
				$deletables[$filename] = true;
                $newEvent->header_pic = $filename;

                //Save Image
                AppUtility::save_image($filename,$image);
            }catch(\Exception $e){
                $errors[] = "Terjadi kesalahan saat mengupload gambar.";
            }
        }
        else{
            if(isset($input['header-pic-old']) && trim($input['header-pic-old'])!=''){
				$filename = $input['header-pic-old'];
                $newEvent->header_pic = $filename;
				$deletables[$filename] = true;
            }
        }
        
        $newEvent->save();
        $oldImages = $newEvent->clear();
        foreach($oldImages as $oldImage){
			$deletables[$oldImage->content]=false;
		}
		
		
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
                    $newEventContent->type = 'i';
                    if($request->hasFile('img-'.$content_id)){
                        try{

                            //ambil file dari 
                            $file = $request->file('img-'.$content_id);
                            //make image
                            $image = Intervention::make($file);

                            //make filename
                            $extension = AppUtility::image_mime_to_extension($image->mime()); 
                            $filename = 'ukm_c_';
                            $filename .= AppUtility::get_random_name('');
                            $filename .= $extension;
							$deletables[$filename]=true;

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
                            $errors[] = "Terjadi kesalahan saat mengupload gambar.";
                        }
                    }
                    else{
                        if(isset($input['content-'.$content_id.'-old'])){   
							$filename = $input['content-'.$content_id.'-old'];
                            $newEventContent->content = $filename;
							$deletables[$filename] = true;
                        }
                    }
                    
                }
                //Save Content
//echo "<pre>".json_encode($newEventContent,JSON_PRETTY_PRINT)."</pre>";
                if($newEventContent->content){
                    $newEventContent->save();
                }
            }
            else{
                break;
            }
            
            $content_id++;
        }
		
		AppUtility::unlink_deletables($deletables);
        
        // Testing Materials
        /*
            echo "<pre>".json_encode($input,JSON_PR
		$errors = array();
		$deleteUkm = Ukm::find($id);
		
		if(!$deleteUkm){
			$errors[] = "Ukm tidak ditemukan";
			return redirect(url('/ukm'))->withErrors($errors);
		}
		
		$oldImages = $deleteUkm->clear();
		$deletables = array();
		foreach($oldImages as $oldImage){
			$deletables[$oldImage->content] = false;
		}
		AppUtility::unlink_deletables($deletables);
		Ukm::destroy($id);
		
		return redirect(url('/ukm'))->with('successMessage','Ukm berhasil di hapus');ETTY_PRINT)."</pre>";
            echo "<pre>";
            print_r($input);
            echo "</pre>";
        */
        
        $errors = array();
        $successMessage = 'Event berhasil diedit';
        $request->session()->flash('successMessage',$successMessage);
        AppUtility::writeLog("melakukan edit event");
        return redirect(url('/event/edit/'.$id))->withErrors($errors)->with('successMessage',$successMessage);
    }
	
	public function delete($id){
		$errors = array();
		$deleteEvent = Event::find($id);
		
		if(!$deleteEvent){
			$errors[] = "Event tidak ditemukan";
			return redirect(url('/event'))->withErrors($errors);
		}
		
		$oldImages = $deleteEvent->clear();
		$deletables = array();
		foreach($oldImages as $oldImage){
			$deletables[$oldImage->content] = false;
		}
		AppUtility::unlink_deletables($deletables);
		Event::destroy($id);
		
        AppUtility::writeLog("melakukan delete event");
		return redirect(url('/event'))->with('successMessage','Event berhasil di hapus');
	}
}
