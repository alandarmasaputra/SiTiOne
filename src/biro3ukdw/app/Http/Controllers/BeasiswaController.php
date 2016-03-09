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

    public function create(){//Request $request){
    	/*$beasiswa = new Beasiswa;
    	$beasiswa->$id = $request->input('id');
    	$beasiswa->$kategori = $request->input('kategori');
    	$beasiswa->$sumber = $request->input('sumber');
    	$beasiswa->$jumlah = $request->input('jumlah');
    	$beasiswa->$header_pic = $request->input('header_pic');
    	$beasiswa->$deadline_date = $request->input('deadline_date');
    	$beasiswa->$created_at = $request->input('created_at');
    	$beasiswa->$updated_at = $request->input('updated_at');
    	*/return view('beasiswa.new');

    	 	
    }
    public function edit(Request $request, $id){
           	$beasiswa = Beasiswa::where('id',$id)->first();
           
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
    public function submit_new(){
    	$beasiswa = new Beasiswa;
    	$beasiswa->$kategori = $request->input('kategori');
    	$beasiswa->$sumber = $request->input('sumber');
    	$beasiswa->$jumlah = $request->input('jumlah');
    	$beasiswa->$header_pic = $request->input('header_pic');
    	$beasiswa->$deadline_date = $request->input('deadline_date');
    	$beasiswa->$updated_at = $request->input('updated_at');

    }

    public function update(Request $request, $id){
    	$beasiswa = Beasiswa::find($id);

           
            //$beasiswa->$kategori = $request->input('kategori');
    		//$beasiswa->$sumber = $request->input('sumber');
    		//$beasiswa->$jumlah = $request->input('jumlah');
    		$beasiswa->header_pic = $request->input('header_pic');
    		//$beasiswa->$deadline_date = $request->input('deadline_date');
    		//$beasiswa->$updated_at = $request->input('updated_at');

    		$beasiswa->save();
        //$beasiswaUpdate = $request->all();
        //$beasiswa = Beasiswa::find($id);
        //$beasiswa->update($beasiswaUpdate);
        echo("suskes");
    }
}
