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
        echo "<pre>".json_encode($ukms,JSON_PRETTY_PRINT)."</pre>"
        
        //return view('')
    }
}
