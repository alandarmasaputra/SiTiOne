<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\AppUtility;
use App\ProfileContent;
use App\User;
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
		$section_top = ProfileContent::where('section_name','section-top')->get();
		$section_middle = ProfileContent::where('section_name','section-middle')->get();
		$section_side = ProfileContent::where('section_name','section-side')->get();
		$section_avatar = ProfileContent::where('section_name','section_avatar')->get();
		$avatars = "";
		foreach($section_avatar as $content){
			$avatars.=" ".$content->content;
		}
		$section_avatar = explode(' ',trim($avatars));
		$avatars = array();
		for($i=0;$i<count($section_avatar);$i++){
			$newUser = User::where('username',$section_avatar[$i])->first();
			if($newUser){
				$avatars[]=$newUser;	
			}
		}
		return view('profil.profil',[
			'section_top' => $section_top,
			'section_middle' => $section_middle,
			'section_side' => $section_side,
			'section_avatar' => $avatars
		]);
	}
	
	public function profiledit(){
		$section_top = ProfileContent::where('section_name','section-top')->get();
		$section_middle = ProfileContent::where('section_name','section-middle')->get();
		$section_side = ProfileContent::where('section_name','section-side')->get();
		$section_avatar = ProfileContent::where('section_name','section_avatar')->get();
		return view('profil.edit',[
			'section_top' => $section_top,
			'section_middle' => $section_middle,
			'section_side' => $section_side,
			'section_avatar' => $section_avatar
		]);
	}
	
	public function profilupdate(Request $request){
		$ret = array();
		$ret['status'] = 0;
		try{
			$data = json_decode($request->data);
			$contents = $data->content;
			$section_name = $data->section_name;
			$strlen = strlen($contents);
			ProfileContent::where('section_name', $section_name)->delete();
			for( $i = 0; $i <= $strlen; $i+=255 ) {
				$content = substr( $contents, $i, 255);
				$newProfileContent = new ProfileContent();
				$newProfileContent->section_name = $section_name;
				$newProfileContent->content = trim($content);
				if($newProfileContent->content){
					$newProfileContent->save();
				}
			}
			$ret['status'] = 1;
		}catch(\Exception $e){
			$ret['message'] = $e->getMessage();
		}
		echo json_encode($ret);
	}
	
	public function profilavatarcheck(Request $request){
		$data = array();
		try{
			$username = $request->username;
			if(User::where('username',$username)->where('auth_level','>','0')->first()!=null){
				$data['status']=1;
				$data['message']="Berhasil menambah staff yang akan ditampilkan";
			}
			else{
				$data['status']=0;
				$data['message']="Staff tidak terdaftar";
			}
		}catch(\Exception $e){
			$data['status']=0;
			$data['message']="Terjadi kesalahan pada server";
		}
		echo json_encode($data);
	}
	
	public function profilavatarsave(Request $request){
		$ret = array();
		$ret['status'] = 0;
		try{
			$section_name = "section_avatar";
			ProfileContent::where('section_name', $section_name)->delete();
			$data = json_decode($request->data);
			$contents = "";
			for( $i = 0; $i < count($data); $i++){
				$contents.=" ".$data[$i];
			}
			$contents = trim($contents);
			
			for( $i = 0; $i <= strlen($contents); $i+=255 ) {
				$content = substr( $contents, $i, 255);
				$newProfileContent = new ProfileContent();
				$newProfileContent->section_name = $section_name;
				$newProfileContent->content = $content;
				$ret[] = $content;
				if($newProfileContent->content){
					$newProfileContent->save();
				}
			}
			$ret['status'] = 1;
		}catch(\Exception $e){
			$ret['message'] = $e->getMessage();
		}
		echo json_encode($ret);
	}
	/*
	public function test(){
		$section_top = ProfileContent::where('section_name','section-top')->get();
		$section_middle = ProfileContent::where('section_name','section-middle')->get();
		$section_side = ProfileContent::where('section_name','section-side')->get();
		$section_avatar = ProfileContent::where('section_name','section_avatar')->get();
		
		echo "<div>";
		$c = "";
		foreach($section_side as $content){
			$c.=$content->content;
		}
		//echo str_replace('&','&amp;',str_replace('>','&gt;',str_replace('<','&lt;',$c)));
		echo $c;
		echo "</div>";
	}*/
}
