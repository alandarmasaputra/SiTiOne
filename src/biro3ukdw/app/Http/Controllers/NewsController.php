<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\NewsContent;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use Input;
use Session;
use Intervention\Image\Facades\Image as Intervention;
use Image;
use App\AppUtility;
use Carbon\Carbon;


class NewsController extends Controller
{   
    //
    public function index(){
      //print news

     $news= News::all();
        return view('news.index',[
            'news'=> $news
        ]);


    }
    

     public function create(){
    
        return view('news.new');
            
    }


    public function detail($id){
        if($id==''){
            return redirect('news');
        }
        $news = News::where('id',$id)->first();
        return view('news.detail',[
            'news' => $news
        ]);
    }

    public function edit($id){
        $news = News::where('id',$id)->first();
        
        if($news==null){
            $errors = array();
            $errors[] = "News yang dituju tidak ditemukan";
            return redirect('/news')->withErrors($errors);
        }
        
        
        $contents = $news->content();
        
        
        return view('news.edit',[
            'news' => $news,
            'news_contents' => $contents
        ]);
    }

    public function submit_new(Request $request){
        $input = $request->all();
        
        //Validasi required input
       
         try{
            $news_name = trim($input['title']);
           
            $kategori_utama = trim($input['kategori-utama']);
        }catch(\Exception $e){
            $errors = array();
            $errors[] = "Terjadi error ketika memproses input";
        }
        
        $errors = array();
        if(!isset($news_name) || $news_name==''){
            $errors[] = "Nama Beasiswa harus diisi";
            
        }
        else{
            $newNews = News::where('name',$news_name)->first();
            
            if($newNews!=null){
                $errors[] = "Nama News sudah ada";
            }
            
        }
        if(!isset($kategori_utama) || $kategori_utama==''){
            $errors[] = "Kategori internal/external harus diisi";
        }
        
        $news_kategori = trim($kategori_utama." ".trim($input['kategori-tambahan']));
        
        //Kalau error redirect kembali
        if(count($errors)>0){
            return back()->withErrors($errors);
        }
    
        $errors = array();
        
        //Save Header
        $newNews = new News();
        $newNews->name = $news_name;
        $newNews->kategori = $news_kategori;
        
        //check if header picture exist
        if($request->hasFile('header-pic')){
            try{
                $file = $request->file('header-pic');

                //make image
                $image = Intervention::make($file);

                //make filename
                $extension = AppUtility::image_mime_to_extension($image->mime()); 
                $filename = 'news_';
                $filename .= AppUtility::get_random_name('');
                $filename .= $extension;

                //compress image
                $image = AppUtility::compress_image($image);

                //Save Image filename
                $newNews->header_pic = $filename;

                //Save Image
                AppUtility::save_image($filename,$image);
            }catch(\Exception $e){
                        echo $e;
                $errors[] = "Terjadi kesalahan saat mengupload gambar.";
            }
        }
        
        $newNews->save();
        $newNews = News::where('name',$news_name)->first();
        
        
        //Make Contents
        $content_id = 0;
        while(true){
            if(isset($input['type-'.$content_id])){
                //New Content
                $newNewsContent = new NewsContent();
                $newNewsContent->news_id = $newNews->id;
                
                //Check Isi Content
                if($input['type-'.$content_id]=="text"){
                    //Set Type Content
                    $newNewsContent->type = 's';
                    
                    
                    $newNewsContent->content = $input['paragraph-'.$content_id];
                }
                else if($input['type-'.$content_id]=="image"){
                    //Set Type Content
                    if($request->hasFile('img-'.$content_id)){
                        try{

                            $newNewsContent->type = 'i';

                            //ambil file dari 
                            $file = $request->file('img-'.$content_id);
                            //make image
                            $image = Intervention::make($file);

                            //make filename
                            $extension = AppUtility::image_mime_to_extension($image->mime()); 
                            $filename = 'news_c_';
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

                            $newNewsContent->content = $filename;
                        }catch(\Exception $e){
                            echo $e;
                            $errors[] = "Terjadi kesalahan saat mengupload gambar.";
                        }
                    }
                    
                }
                
                //Save Content
                $newNewsContent->save();
            }
            else{
                break;
            }
            
            $content_id++;
        }
        
        
        
        $successMessage = 'News berhasil terdaftar';
        return back()
            ->with('successMessage',$successMessage)
            ->withErrors($errors);
    }


       public function update(Request $request, $id){
        $input = $request->all();
                                                       
        try{
            $news_name = trim($input['title']);
           
            $kategori_utama = trim($input['kategori-utama']);
        }catch(\Exception $e){
            $errors = array();
            $errors[] = "Terjadi error ketika memproses input";
        }
        
        $errors = array();
         if(!isset($news_name) || $news_name==''){
            $errors[] = "Nama News harus diisi";
            
        }
        
        if(!isset($kategori_utama) || $kategori_utama==''){
            $errors[] = "Kategori internal/external harus diisi";
        }
        
        $news_kategori = trim($kategori_utama." ".trim($input['kategori-tambahan']));
        
        //Kalau error redirect kembali
        if(count($errors)>0){
            return back()->withErrors($errors)->withInput();
        }
        
        $newNews = News::where('id',$id)->first();
            
        //Initialization Error
        $errors = array();
        
        //Save Header;
        $newNews->name = $news_name;
        $newNews->kategori = $news_kategori;
        
        //check if header picture exist
        if($request->hasFile('header-pic')){
            try{
                $file = $request->file('header-pic');

                //make image
                $image = Intervention::make($file);

                //make filename
                $extension = AppUtility::image_mime_to_extension($image->mime()); 
                $filename = 'news_';
                $filename .= AppUtility::get_random_name('');
                $filename .= $extension;

                //compress image
                $image = AppUtility::compress_image($image);

                //Save Image filename
                $newNews->header_pic = $filename;

                //Save Image
                AppUtility::save_image($filename,$image);
            }catch(\Exception $e){
                $errors[] = "Terjadi kesalahan saat mengupload gambar.";
            }
        }
        else{
            if(isset($input['header-pic-old']) && trim($input['header-pic-old'])!=''){
                $newNews->header_pic = $input['header-pic-old'];
            }
        }
        
        $newNews->save();
        $newNews->clear();
        
        //Make Contents
        $content_id = 0;
        while(true){
            if(isset($input['type-'.$content_id])){
                //New Content
                $newNewsContent = new NewsContent();
                $newNewsContent->news_id = $newNews->id;
                
                //Check Isi Content
                if($input['type-'.$content_id]=="text"){
                    //Set Type Content
                    $newNewsContent->type = 's';
                    $newNewsContent->content = $input['paragraph-'.$content_id];
                }
                else if($input['type-'.$content_id]=="image"){
                    //Set Type Content
                    $newNewsContent->type = 'i';
                    if($request->hasFile('img-'.$content_id)){
                        try{

                            //ambil file dari 
                            $file = $request->file('img-'.$content_id);
                            //make image
                            $image = Intervention::make($file);

                            //make filename
                            $extension = AppUtility::image_mime_to_extension($image->mime()); 
                            $filename = 'news_c_';
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

                            $newNewsContent->content = $filename;
                        }catch(\Exception $e){
                            $errors[] = "Terjadi kesalahan saat mengupload gambar.";
                        }
                    }
                    else{
                        if(isset($input['content-'.$content_id.'-old'])){   
                            $newNewsContent->content = $input['content-'.$content_id.'-old'];
                        }
                    }
                    
                }
                //Save Content
                echo "<pre>".json_encode($newNewsContent,JSON_PRETTY_PRINT)."</pre>";
                if($newNewsContent->content){
                    $newNewsContent->save();
                }
            }
            else{
                break;
            }
            
            $content_id++;
        }
        
        
        $errors = array();
        $successMessage = 'News berhasil diedit';
        $request->session()->flash('successMessage',$successMessage);
        return redirect(url('/news/'.$id))->withErrors($errors)->with('successMessage',$successMessage);
    }





    function delete($id){
        $errors = array();
        $deleteNews= News::find($id);
        
        if(!$deleteNews){
            $errors[] = "News tidak ditemukan";
            return redirect(url('/news'))->withErrors($errors);
        }
        
        $oldImages = $deleteNews->clear();
        $deletables = array();
        foreach($oldImages as $oldImage){
            $deletables[$oldImage->content] = false;
        }
        AppUtility::unlink_deletables($deletables);
        News::destroy($id);
        
        return redirect(url('/news'))->with('successMessage','News berhasil di hapus');
    }



    function getList(Request $request){
        
        try{
            $news = News::where('name','like','%'.$request->all()['query'].'%')
                ->orWhere('kategori','like','%'.$request->all()['query'].'%')
                ->orderBy('id','desc')
                ->get();
            return view('news.list',[
                'news'=>$news
            ]);
        }
        catch(\Exception $e){
            echo $e;
        }
    }















    
}