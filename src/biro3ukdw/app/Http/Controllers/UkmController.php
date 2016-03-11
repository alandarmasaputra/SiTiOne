<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ukm;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UkmController extends Controller
{
    function index(){
        $ukms = Ukm::get();
        return view('ukm.index',[
            'ukms'=>$ukms
        ]);
    }
    
    function create(){
        return view('ukm.new');
    }
    function submit_new(Request $request){
        $input = $request->all();
        $ukm = new Ukm;
        return Redirect::back()->withInput();
    }
    
    function edit(){
    
    }
    function submitEdit(){
    
    }
}
