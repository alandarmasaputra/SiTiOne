<?php

namespace App\Http\Controllers;

use Request;
use App\News;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class NewsController extends Controller
{
    //
    
    

    public function edit($id){
           $news = News::find($id);
           return view('news.edit', compact('news'));
    }

    public function new(){
            return view('news.new'); 
    }

     public function detail($id){
            $news = News::find($id);
            return view('news.detail', compact('news')); 
    }

    public function update($id)
    {
        
        $newsUpdate = Request::all();
        $news = News::find($id);
        $news->update($newsUpdate);
        echo("suskes");
    }

      

}
