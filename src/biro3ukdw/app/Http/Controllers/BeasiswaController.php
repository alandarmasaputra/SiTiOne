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
        try{
			$beasiswa_name = trim($input['title']);
			$beasiswa_sumber = trim($input['sumber']);
			$beasiswa_deadline_date = Carbon::createFromFormat('Y-m-d', $request->input('deadline-date'));
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

    public function update(Request $request, $id){
    	$beasiswa = Beasiswa::find($id);
        $beasiswa->kategori = $request->input('kategori');
    	$beasiswa->sumber = $request->input('sumber');
    	$beasiswa->jumlah = $request->input('jumlah');
    	$beasiswa->header_pic = $request->input('header_pic');
    	$beasiswa->deadline_date = $request->input('deadline-date');
    	$beasiswa->save();
        return redirect('/beasiswa/edit/'.$id);
    }
}
