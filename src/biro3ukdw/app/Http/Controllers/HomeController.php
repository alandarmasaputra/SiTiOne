<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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
}
