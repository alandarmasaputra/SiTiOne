<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\AppUtility;
use Illuminate\Http\Request;
use App\News;
use App\Beasiswa;
use App\Ukm;
use App\Event;
use Auth;

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
		$newss = News::orderBy('id','desc')->get();
		$ukms = Ukm::orderBy('id','desc')->get();
		$beasiswas = Beasiswa::orderBy('id','desc')->get();
		$events = Event::orderBy('id','desc')->get();
		
		$carousel = array();
		
		foreach($newss as $news){
			if($news->header_pic){
				$carousel['news'] = $news;
				break;
			}
		}
		
		foreach($beasiswas as $beasiswa){
			if($beasiswa->header_pic){
				$carousel['beasiswa'] = $beasiswa;
				break;
			}
		}
		
		foreach($events as $event){
			if($event->header_pic){
				$carousel['event'] = $event;
				break;
			}
		}
		
		$ukmWithPic = array();
		foreach($ukms as $ukm){
			if($ukm->header_pic){
				$ukmWithPic[] = $ukm;
			}
		}
		
		if(count($ukmWithPic)>0){
			$index = mt_rand(0,count($ukmWithPic)-1);
			$carousel['ukm'] = $ukmWithPic[$index];
		}
		
		
		return view('home',[
			'newss'=>$newss,
			'ukms'=>$ukms,
			'beasiswas'=>$beasiswas,
			'events'=>$events,
			'carousel'=>$carousel
		]);
    }
	
	public function login(){
		if(Auth::user()){
			return redirect('/');
		}
		return view('auth.login');
	}
	
	public function trylogin(Request $request){
		if(Auth::user()){
			return redirect('/');
		}
		
		$username = $request->input('username');
		$password = $request->input('password');
		$errors = array();
		
		if($username == null || trim($username)==''){
			$errors[] = "username tidak boleh kosong";
		}
		
		if($password == null || trim($password)==''){
			$errors[] = "password tidak boleh kosong";
		}
		
		if(count($errors)>0){
			return redirect('/login')->withErrors($errors);
		}
		
		if(Auth::attempt(['username'=>$username, 'password'=>$password])){
			if(Auth::user()->is_aktif==false){
				Auth::logout();
				$errors[] = "username atau password salah.";
				return redirect('/login')->withErrors($errors);
			}
			
			
			$successMessage = "Telah berhasil login";
			return redirect()->intended('/')->with('successMessage',$successMessage);
		}else{
			$errors[] = "username atau password salah.";
			return redirect('/login')->withErrors($errors);
		}
		
	}
	
	public function logout(){
		Auth::logout();
		$successMessage = "Telah berhasil logout";
		return redirect('/')->with('successMessage',$successMessage);
	}
	
	public function profil(){
		return view('profil.profil');
	}
	
	public function profiledit(){
		return view('profil.profiledit');
	}
	
	public function profilupdate(Request $request){
		$data = json_decode($request->data);
		$contents = $data->content;
		$content_id = 0;
		$strlen = strlen( $content );
		ProfileContent::where('section_name', $this->section_name)->delete();
		for( $i = 0; $i <= $strlen; $i+=255 ) {
			$newProfileContent = new ProfileContent();
			$newProfileContent->section_name = $section_name;
    		$content = substr( $contents, $i, 255);
                if($newProfileContent->content){
                    $newProfileContent->save();
                }
            $content_id++;
    	
		}
        
		return view('profil');
	}
}
