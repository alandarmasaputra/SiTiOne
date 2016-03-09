<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beasiswa;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BeasiswaController extends Controller
{
    public function index(){
    	//print news
        $beasiswa=Beasiswa::orderBy('created_at','desc')->get();
        //echo "<pre>".json_encode($beasiswa,JSON_PRETTY_PRINT)."</pre>";
        return View::make('beasiswa.index');

    }
    public function submit_new(Request $request){
    	$name = $request->input('name');

    	 	
    }
    public function submit_edit($id){
           $beasiswa = Beasiswa::find($id);
           return view('beasiswa.edit', compact('beasiswa'));
    }

    /*public function new(){
            return view('beasiswa.new'); 
    }*/

     public function detail($id){
            $beasiswa = Beasiswa::find($id);
            return view('beasiswa.detail', compact('beasiswa')); 
     		//return view('beasiswa.detail', ['beasiswa' => beasiswa::findOrFail($id)]);

    }

    public function update($id){
            $beasiswa = Beasiswa::find($id);
            $beasiswa->update($beasiswa);
            return view('beasiswa.edit', compact('beasiswa')); 
    }
}
