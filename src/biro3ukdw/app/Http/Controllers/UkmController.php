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
	private $maxTitleLength = 200;
    function index(){
        $ukms = Ukm::get();
        return view('ukm.index');
    }
	
	function getList(Request $request){
		
		try{
			$ukms = Ukm::where('name','like','%'.$request->all()['query'].'%')
				->orderBy('id','desc')
				->get();
			return view('ukm.list',[
				'ukms'=>$ukms
			]);
		}
		catch(\Exception $e){
			echo $e;
		}
	}
    
    function create(){
        return view('ukm.new');
    }
    
    function detail($id){
		if($id==''){
			return redirect('ukm');
		}
        $ukm = UKM::where('id',$id)->first();
        return view('ukm.detail',[
            'ukm' => $ukm
        ]);
    }
    
    
    /*
    *Submit new UKM entry
    */
    function submit_new(Request $request){
        $input = $request->all();
        
        //Validasi required input
        $ukm_name = trim($input['title']);
        
        $errors = array();
        if(!isset($ukm_name) || $ukm_name==''){
            $errors[] = "Nama UKM harus diisi";
            
        }
        else{
            $newUkm = UKM::where('name',$ukm_name)->first();
            
            if($newUkm!=null){
                $errors[] = "Nama UKM sudah ada";
            }
			
			if(strlen($ukm_name)>$this->maxTitleLength){
				$errors[] = "Nama UKM tidak boleh lebih dari .".$this->maxTitleLength." huruf";
			}
            
        }
        
        //Kalau error redirect kembali
        if(count($errors)>0){
            return back()->withErrors($errors);
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
    
    
    function edit($id){
        $ukm = Ukm::where('id',$id)->first();
		
		if($ukm==null){
			$errors = array();
			$errors[] = "Ukm yang dituju tidak ditemukan";
			return redirect('/ukm')->withErrors($errors);
		}
        
		
		$contents = $ukm->content();
		
		
        return view('ukm.edit',[
            'ukm' => $ukm,
            'ukm_contents' => $contents
        ]);
    }
    
    function delete($id){
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
		
		return redirect(url('/ukm'))->with('successMessage','Ukm berhasil di hapus');
	}
    
    /*
    **Editing Submission
    **
    **
    */
    function update(Request $request, $id){
		$input = $request->all();
		$deletables = array();
                                                       
        $ukm_name = trim($input['title']);
        
        $errors = array();
        if(!isset($ukm_name) || $ukm_name==''){
            $errors[] = "Nama UKM harus diisi";
        }
        else{
            $newUkm = UKM::where('name',$ukm_name)->where('id','!=',$id)->first();
            
            if($newUkm!=null){
                $errors[] = "Nama UKM sudah ada";
            }
			
			if(strlen($ukm_name)>$this->maxTitleLength){
				$errors[] = "Nama UKM tidak boleh lebih dari ".$this->maxTitleLength." huruf";
			}
        }
        
        //Kalau error redirect kembali
        if(count($errors)>0){
            return back()->withErrors($errors)->withInput();
        }
        
        $newUkm = Ukm::where('id',$id)->first();
            
        //Initialization Error
        $errors = array();
        
        //Save Header;
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
				$deletables[$newUkm->header_pic] = false;
				$deletables[$filename] = true;
                //Save Image filename
                $newUkm->header_pic = $filename;

                //Save Image
                AppUtility::save_image($filename,$image);
            }catch(\Exception $e){
                $errors[] = "Terjadi kesalahan saat mengupload gambar.";
            }
        }
		else{
			if(isset($input['header-pic-old']) && trim($input['header-pic-old'])!=''){
				$filename = $input['header-pic-old'];
				$newUkm->header_pic = $filename;
				$deletables[$filename] = true;
			}
		}
        
        $newUkm->save();
        $oldImages = $newUkm->clear();
        
		foreach($oldImages as $oldImage){
			$deletables[$oldImage->content] = false;
		}
		
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
                    $newUkmContent->type = 'i';
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
                    else{
                        if(isset($input['content-'.$content_id.'-old'])){   
							$filename = $input['content-'.$content_id.'-old'];
                            $newUkmContent->content = $filename;
							$deletables[$filename] = true;
                        }
                    }
                    
                }
                //Save Content
                //echo "<pre>".json_encode($newUkmContent,JSON_PRETTY_PRINT)."</pre>";
				if($newUkmContent->content){
                	$newUkmContent->save();
				}
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
		
		AppUtility::unlink_deletables($deletables);
		
		$errors = array();
        $successMessage = 'UKM berhasil diedit';
        $request->session()->flash('successMessage',$successMessage);
        return redirect(url('/ukm/'.$id))->withErrors($errors)->with('successMessage',$successMessage);
    }
}
