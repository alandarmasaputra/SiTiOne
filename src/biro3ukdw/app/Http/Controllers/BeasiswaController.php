<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beasiswa;
use App\BeasiswaContent;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use Input;
use Session;
use Intervention\Image\Facades\Image as Intervention;
use Image;
use App\AppUtility;

class BeasiswaController extends Controller
{
    public function index(){
        $beasiswas = Beasiswa::all();
        return view('beasiswa.index',[
            'beasiswas'=> $beasiswas
        ]);

    }

    public function create(){
    	
    	return view('beasiswa.new');
    	 	
    }
    public function edit($id){
           	$beasiswa = Beasiswa::where('id',$id)->first();
            return view('beasiswa.edit', compact('beasiswa'));
    }

     public function detail($id){
            $beasiswa = Beasiswa::where('id',$id)->first();
        return view('beasiswa.detail',[
            'beasiswa' => $beasiswa
        ]);
     		
    }
    public function submit_new(Request $request){
    	$input = $request->all();
        
        //Validasi required input
        $beasiswa_name = trim($input['title']);
        
        $errors = array();
        if(!isset($beasiswa_name) || $beasiswa_name==''){
            $errors[] = "Nama Beasiswa harus diisi";
            
        }
        else{
            $newBeasiswa = Beasiswa::where('name',$beasiswa_name)->first();
            
            if($newBeasiswa!=null){
                $errors[] = "Nama Beasiswa sudah ada";
            }
            
        }
        
        //Kalau error redirect kembali
        if(count($errors)>0){
            return back()->withErrors($errors);
        }
    
        $errors = array();
        
        //Save Header
        $newBeasiswa = new Beasiswa();
        $newBeasiswa->name = $beasiswa_name;
        
        //check if header picture exist
        if($request->hasFile('header-pic')){
            try{
                $file = $request->file('header-pic');

                //make image
                $image = Intervention::make($file);

                //make filename
                $extension = AppUtility::image_mime_to_extension($image->mime()); 
                $filename = 'beasiswa_';
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
    	$beasiswa = Beasiswa::find($id);
        $beasiswa->kategori = $request->input('kategori');
    	$beasiswa->sumber = $request->input('sumber');
    	$beasiswa->jumlah = $request->input('jumlah');
    	$beasiswa->header_pic = $request->input('header_pic');
    	$beasiswa->deadline_date = $request->input('deadline_date');
    	$beasiswa->save();
        return redirect('/beasiswa/edit/'.$id);
    }
}
