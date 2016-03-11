<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\News;
use App\Ukm;
use App\Beasiswa;
use App\Event;
class HomeController extends Controller
{
    public function index(){
        $newss = News::get();
        $ukms = Ukm::get();
        $beasiswas = Beasiswa::get();
        $events = Event::get();
    	return view('home',[
            'newss'=>$newss,
            'ukms'=>$ukms,
            'beasiswas'=>$beasiswas,
            'events'=>$events
        ]);
    }
}
