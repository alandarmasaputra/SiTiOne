<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\News;
class HomeController extends Controller
{
    public function index(){
    	//print news
        $news=News::orderBy('created_at','desc')
        ->get();

        //return view('')
         echo "<pre>".json_encode($news,JSON_PRETTY_PRINT)."</pre>";


    }
}
