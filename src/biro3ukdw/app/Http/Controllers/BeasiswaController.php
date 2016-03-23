<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beasiswa;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BeasiswaController extends Controller
{
    public function index(){
        $beasiswas = Beasiswa::all();
        return view('beasiswa.index',[
            'beasiswas'=> $beasiswas
        ]);

    }

    public function create(){
    	
    	return view('beasiswa.create');
    	 	
    }
    public function edit($id){
           	$beasiswa = Beasiswa::where('id',$id)->first();
            return view('beasiswa.edit', compact('beasiswa'));
    }

     public function detail($id){
            $beasiswa = Beasiswa::where('id',$id)->first();
            return view('beasiswa.detail', compact('beasiswa')); 
     		
    }
    public function submit_new(Request $request){
    	$beasiswa = new Beasiswa;
    	$beasiswa->kategori = $request->input('kategori');
    	$beasiswa->sumber = $request->input('sumber');
    	$beasiswa->jumlah = $request->input('jumlah');
    	$beasiswa->header_pic = $request->input('header_pic');
    	$beasiswa->deadline_date = $request->input('deadline_date');
        $beasiswa->save();
        return redirect('/beasiswa/new/');
    }

    public function update(Request $request, $id){
    	$beasiswa = Beasiswa::find($id);
        $beasiswa->kategori = $request->input('kategori');
    	$beasiswa->sumber = $request->input('sumber');
    	$beasiswa->jumlah = $request->input('jumlah');
    	$beasiswa->header_pic = $request->input('header_pic');
    	$beasiswa->deadline_date = $request->input('deadline_date');
    	$beasiswa->save();
        return redirect('/beasiswa/edit/'.$id);
    }
}
