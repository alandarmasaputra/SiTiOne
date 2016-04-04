<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\News;
use App\Beasiswa;
use App\Ukm;
use App\Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
