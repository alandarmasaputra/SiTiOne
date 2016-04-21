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
use Carbon\Carbon;

class BeasiswaController extends Controller
{
    public function index(){
        $beasiswas = Beasiswa::orderBy('created_at','desc')->get();
        return view('beasiswa.index',[
            'beasiswas'=> $beasiswas
        ]);

    }
	
	function getList(Request $request){
		
		try{
			$beasiswas = Beasiswa::where('name','like','%'.$request->all()['query'].'%')
				->orWhere('kategori','like','%'.$request->all()['query'].'%')
				->orderBy('id','desc')
				->get();
			return view('beasiswa.list',[
				'beasiswas'=>$beasiswas
			]);
		}
		catch(\Exception $e){
			echo $e;
		}
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
        try{
			$beasiswa_name = trim($input['title']);
			$beasiswa_sumber = trim($input['sumber']);
			$beasiswa_deadline_date_string = $request->input('deadline-date');
			if(trim($beasiswa_deadline_date_string)!=''){
				$beasiswa_deadline_date = Carbon::createFromFormat('Y-m-d', $beasiswa_deadline_date_string);
			}
			else{
				$beasiswa_deadline_date = null;
			}
			$kategori_utama = trim($input['kategori-utama']);
		}catch(\Exception $e){
			$errors = array();
			$errors[] = "Terjadi error ketika memproses input";
		}
		
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
		if(!isset($kategori_utama) || $kategori_utama==''){
			$errors[] = "Kategori internal/external harus diisi";
		}
        
		$beasiswa_kategori = trim($kategori_utama." ".trim($input['kategori-tambahan']));
		
        //Kalau error redirect kembali
        if(count($errors)>0){
            return back()->withErrors($errors);
        }
    	
		$errors = array();
        
        //Save Header
        $newBeasiswa = new Beasiswa();
        $newBeasiswa->name = $beasiswa_name;
		$newBeasiswa->sumber = $beasiswa_sumber;
		$newBeasiswa->deadline_date = $beasiswa_deadline_date;
		$newBeasiswa->kategori = $beasiswa_kategori;
        
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
                $newBeasiswa->header_pic = $filename;

                //Save Image
                AppUtility::save_image($filename,$image);
            }catch(\Exception $e){
                        echo $e;
                $errors[] = "Terjadi kesalahan saat mengupload gambar.";
            }
        }
        $newBeasiswa->save();
        $newBeasiswa = Beasiswa::where('name',$beasiswa_name)->first();
        
        
        //Make Contents
        $content_id = 0;
        while(true){
            if(isset($input['type-'.$content_id])){
                //New Content
                $newBeasiswaContent = new BeasiswaContent();
                $newBeasiswaContent->beasiswa_id = $newBeasiswa->id;
                
                //Check Isi Content
                if($input['type-'.$content_id]=="text"){
                    //Set Type Content
                    $newBeasiswaContent->type = 's';
                    
                    
                    $newBeasiswaContent->content = $input['paragraph-'.$content_id];
                }
                else if($input['type-'.$content_id]=="image"){
                    //Set Type Content
                    if($request->hasFile('img-'.$content_id)){
                        try{

                            $newBeasiswaContent->type = 'i';

                            //ambil file dari 
                            $file = $request->file('img-'.$content_id);
                            //make image
                            $image = Intervention::make($file);

                            //make filename
                            $extension = AppUtility::image_mime_to_extension($image->mime()); 
                            $filename = 'beasiswa_c_';
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

                            $newBeasiswaContent->content = $filename;
                        }catch(\Exception $e){
                            echo $e;
                            $errors[] = "Terjadi kesalahan saat mengupload gambar.";
                        }
                    }
                    
                }
                
                //Save Content
                $newBeasiswaContent->save();
            }
            else{
                break;
            }
            
            $content_id++;
        }
        
        
        
        $successMessage = 'Beasiswa berhasil terdaftar';
        return back()
            ->with('successMessage',$successMessage)
            ->withErrors($errors);
		
        /**/
    }
	
	function delete($id){
		$errors = array();
		$deleteBeasiswa = Beasiswa::find($id);
		
		if(!$deleteBeasiswa){
			$errors[] = "Beasiswa tidak ditemukan";
			return redirect(url('/beasiswa'))->withErrors($errors);
		}
		
		$oldImages = $deleteBeasiswa->clear();
		$deletables = array();
		foreach($oldImages as $oldImage){
			$deletables[$oldImage->content] = false;
		}
		AppUtility::unlink_deletables($deletables);
		Beasiswa::destroy($id);
		
		return redirect(url('/beasiswa'))->with('successMessage','Beasiswa berhasil di hapus');
	}

    public function update(Request $request, $id){
		
		
    	$input = $request->all();
        $deletables = array();
        
        //Validasi required input
        try{
			$beasiswa_name = trim($input['title']);
			$beasiswa_sumber = trim($input['sumber']);
			$beasiswa_deadline_date_string = $request->input('deadline-date');
			if($beasiswa_deadline_date_string){
				$beasiswa_deadline_date = Carbon::createFromFormat('Y-m-d', $beasiswa_deadline_date_string);
			}
			else{
				$beasiswa_deadline_date = null;
			}
			$kategori_utama = trim($input['kategori-utama']);
		}catch(\Exception $e){
			$errors = array();
			$errors[] = "Terjadi error ketika memproses input";
		}
		
		$errors = array();
        if(!isset($beasiswa_name) || $beasiswa_name==''){
            $errors[] = "Nama Beasiswa harus diisi";
            
        }
		
		if(!isset($kategori_utama) || $kategori_utama==''){
			$errors[] = "Kategori internal/external harus diisi";
		}
        
		$beasiswa_kategori = trim($kategori_utama." ".trim($input['kategori-tambahan']));
		
        //Kalau error redirect kembali
        if(count($errors)>0){
            return back()->withErrors($errors);
        }
    	
		$errors = array();
        
        //Save Header
        $newBeasiswa = Beasiswa::where('id',$id)->first();
		if($newBeasiswa==null){
			$errors[] = "Beasiswa yang diedit tidak ditemukan";
			return redirect('/beasiswa')->withErrors($errors);
		}
		
        $newBeasiswa->name = $beasiswa_name;
		$newBeasiswa->sumber = $beasiswa_sumber;
		$newBeasiswa->deadline_date = $beasiswa_deadline_date;
		$newBeasiswa->kategori = $beasiswa_kategori;
		
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
				if($newBeasiswa->header_pic){
        			$deletables[$newBeasiswa->header_pic]=false;
				}
				
                $newBeasiswa->header_pic = $filename;
        		
				$deletables[$filename]=true;

                //Save Image
                AppUtility::save_image($filename,$image);
            }catch(\Exception $e){
                echo $e;
                $errors[] = "Terjadi kesalahan saat mengupload gambar.";
            }
        }
		else{
			if(isset($input['header-pic-old']) && trim($input['header-pic-old'])!=''){
				$filename = $input['header-pic-old'];
				$newBeasiswa->header_pic = $filename;
        		$deletables[$filename]=true;
			}
		}
        $newBeasiswa->save();
		$oldImages = $newBeasiswa->clear();
		
        foreach($oldImages as $oldImage){
			$deletables[$oldImage->content] = false;
		}
		
        //Make Contents
        $content_id = 0;
        while(true){
            if(isset($input['type-'.$content_id])){
                //New Content
                $newBeasiswaContent = new BeasiswaContent();
                $newBeasiswaContent->beasiswa_id = $newBeasiswa->id;
                
                //Check Isi Content
                if($input['type-'.$content_id]=="text"){
                    //Set Type Content
                    $newBeasiswaContent->type = 's';
                    $newBeasiswaContent->content = $input['paragraph-'.$content_id];
                }
                else if($input['type-'.$content_id]=="image"){
                    //Set Type Content
                    $newBeasiswaContent->type = 'i';
                    if($request->hasFile('img-'.$content_id)){
                        try{

                            //ambil file dari 
                            $file = $request->file('img-'.$content_id);
                            //make image
                            $image = Intervention::make($file);

                            //make filename
                            $extension = AppUtility::image_mime_to_extension($image->mime()); 
                            $filename = 'beasiswa_c_';
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
							$deletables[$filename] = true;

                            $newBeasiswaContent->content = $filename;
                        }catch(\Exception $e){
                            echo $e;
                            $errors[] = "Terjadi kesalahan saat mengupload gambar.";
                        }
                    }
                    else{
						if(isset($input['content-'.$content_id.'-old'])){
							$filename = $input['content-'.$content_id.'-old'];
                            $newBeasiswaContent->content = $filename;
							$deletables[$filename] = true;
						}
					}
                }
                
                //Save Content
                $newBeasiswaContent->save();
            }
            else{
                break;
            }
            
			AppUtility::unlink_deletables($deletables);
			
            $content_id++;
        }
        
        
        
        $successMessage = 'Beasiswa berhasil terdaftar';
        return back()
            ->with('successMessage',$successMessage)
            ->withErrors($errors);
		
        /**/
    }
}
