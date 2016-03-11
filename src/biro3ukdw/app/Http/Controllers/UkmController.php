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
    function submitNew(){
        
    }
    
    function edit(){
    
    }
    function update(){
    
    }
}
