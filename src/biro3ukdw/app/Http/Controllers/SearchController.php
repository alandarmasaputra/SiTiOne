<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ukm;
use App\Event;
use App\News;
use App\Beasiswa;

class SearchController extends Controller
{
    function search(Request $request){
		$q = $request->q;
		$ukms = Ukm::where('name','like','%'.$q.'%')->get();
		$events = Event::where('name','like','%'.$q.'%')
			->orWhere('kategori','like','%'.$q.'%')
			->orWhere('sumber','like','%'.$q.'%')
			->orWhere('tempat','like','%'.$q.'%')
			->get();
		$news = News::where('name','like','%'.$q.'%')
			->orWhere('kategori','like','%'.$q.'%')
			->get();
		$beasiswa = Beasiswa::where('name','like','%'.$q.'%')
			->orWhere('kategori','like','%'.$q.'%')
			->orWhere('sumber','like','%'.$q.'%')
			->get();
	}
}
