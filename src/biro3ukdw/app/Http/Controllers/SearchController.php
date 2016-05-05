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
	private $itemPerPage = 3;
	function event(Request $request){
		$q = $request->q;
		$page = $request->pageNumber;
		$limit=$this->itemPerPage;
		$skip=($page-1)*$limit;
		$events = Event::where('name','like','%'.$q.'%')
			->orWhere('kategori','like','%'.$q.'%')
			->orWhere('sumber','like','%'.$q.'%')
			->orWhere('tempat','like','%'.$q.'%')
			->skip($skip)->take($limit)->get();
		return view('search.event',[
			'events' => $events
		]);
	}
	function ukm(Request $request){
		$q = $request->q;
		$page = $request->pageNumber;
		$limit=$this->itemPerPage;
		$skip=($page-1)*$limit;
		$ukms = Ukm::where('name','like','%'.$q.'%')
			->skip($skip)->take($limit)->get();
		return view('search.ukm',[
			'ukms' => $ukms
		]);
	}
	
	function beasiswa(Request $request){
		$q = $request->q;
		$page = $request->pageNumber;
		$limit=$this->itemPerPage;
		$skip=($page-1)*$limit;
		$beasiswas = Beasiswa::where('name','like','%'.$q.'%')
			->orWhere('kategori','like','%'.$q.'%')
			->orWhere('sumber','like','%'.$q.'%')
			->skip($skip)->take($limit)->get();
		return view('search.beasiswa',[
			'beasiswas'=>$beasiswas
		]);
	}
	function news(Request $request){
		$q = $request->q;
		$page = $request->pageNumber;
		$limit=$this->itemPerPage;
		$skip=($page-1)*$limit;
		$news = News::where('name','like','%'.$q.'%')
			->orWhere('kategori','like','%'.$q.'%')
			->skip($skip)->take($limit)->get();
		return view('search.news',[
			'news'=>$news
		]);
	}
    function search(Request $request){
		$q = $request->q;
		$limit=$this->itemPerPage;
		$ukmCount = Ukm::where('name','like','%'.$q.'%')
			->count();
		$eventCount = Event::where('name','like','%'.$q.'%')
			->orWhere('kategori','like','%'.$q.'%')
			->orWhere('sumber','like','%'.$q.'%')
			->orWhere('tempat','like','%'.$q.'%')
			->count();
		$newsCount = News::where('name','like','%'.$q.'%')
			->orWhere('kategori','like','%'.$q.'%')
			->count();
		$beasiswaCount = Beasiswa::where('name','like','%'.$q.'%')
			->orWhere('kategori','like','%'.$q.'%')
			->orWhere('sumber','like','%'.$q.'%')
			->count();
		return view('search.result', [
			'query' =>  $q,
			'ukmCount' => $ukmCount/$limit + ($ukmCount % $limit > 0 ? 1 : 0) ,
			'beasiswaCount' => $beasiswaCount/$limit + ($beasiswaCount % $limit > 0 ? 1 : 0) ,
			'newsCount' => $newsCount/$limit + ($newsCount % $limit > 0 ? 1 : 0) ,
			'eventCount' => $eventCount/$limit + ($eventCount % $limit > 0 ? 1 : 0) 
		]);
	}
}
