<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class NewsController extends Controller
{
    //
    public function index(){
      //print news
        $news=News::orderBy('created_at','desc')->get();
        //echo "<pre>".json_encode($beasiswa,JSON_PRETTY_PRINT)."</pre>";
        return View::make('news.index');

    }
    

    public function edit(Request $request, $id){
            $news = News::where('id',$id)->first();
            return view('news.edit', compact('news'));

    }

   // public function new(){
            //return view('news.new'); 
  //  }
//
     public function detail($id){
            $news = News::find($id);
            return view('news.detail', compact('news')); 
    }

    public function update(Request $request, $id)
    {
        $news = News::find($id);
        $news->header_pic = $request->input('header_pic');
        $news->save();
        echo("suskes");
    }

      

}
