<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ukm;
use App\UkmContent;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use Input;
use Session;
use Intervention\Image\Facades\Image as Intervention;
use Image;
use App\AppUtility;

class UkmController extends Controller
{
    
    public function __construct(){
    }
    
    function index(){
        $ukms = Ukm::get();
        return view('ukm.index',[
            'ukms'=>$ukms
        ]);
    }
    
    function create(){
        return view('ukm.new');
    }
    function submit_new(Request $request){
        $input = $request->all();
        
        //Validasi required input
        $ukm_name = trim($input['title']);
        
        
        if(!isset($ukm_name) || $ukm_name==''){
            $error_message = "Nama UKM harus diisi";
            
        }
        else{
            $newUkm = UKM::where('name',$ukm_name)->first();
            
            if($newUkm!=null){
                $error_message = "Nama UKM sudah ada";
            }
            
        }
        
        //Kalau error redirect kembali
        if(isset($error_message)){
            echo $error_message;
            return back()->with('error_message',$error_message)->withInput();
        }
    
        $errors = array();
        
        //Save Header
        $newUkm = new Ukm();
        $newUkm->name = $ukm_name;
        
        //check if header picture exist
        if($request->hasFile('header-pic')){
            try{
                $file = $request->file('header-pic');

                //make image
                $image = Intervention::make($file);

                //make filename
                $extension = AppUtility::image_mime_to_extension($image->mime()); 
                $filename = 'ukm_';
                $filename .= AppUtility::get_random_name('');
                $filename .= $extension;

                //compress image
                $image = AppUtility::compress_image($image);

                //Save Image filename
                $newUkm->header_pic = $filename;

                //Save Image
                AppUtility::save_image($filename,$image);
            }catch(\Exception $e){
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
                    try{
                        
                        $newUkmContent->type = 'i';

                        $file = $request->file('image-'.$content_id);

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
                        $errors[] = "Terjadi kesalahan saat mengupload gambar.";
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
        
            echo "<pre>".json_encode($input,JSON_PRETTY_PRINT)."</pre>";
            echo "<pre>";
            print_r($input);
            echo "</pre>";
        
        
        
        $success_message = 'UKM berhasil terdaftar';
        return back()
            ->with('success_message',$success_message)
            ->withErrors($errors);
    }
    
    function edit(){
    
    }
    function submitEdit(){
    
    }
}
