<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Input;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Redirect;






class UserController extends Controller
{
	function loginpage(){
		
	}
	
	public function index()
	{
		if(Auth::user()->auth_level>1){
			$errors = array();
			$errors[] = "Anda tidak berhak mengakses halaman berikut.";
			return redirect('/')->withErrors($errors);
		}
		$user = User::where('auth_level','>','0')->where('id','<>',Auth::user()->id)->get();
		return view('crud.index', compact('user'));
	}


	function edit($id)
	{
		if(Auth::user()->auth_level>1){
			$errors = array();
			$errors[] = "Anda tidak berhak mengakses halaman berikut.";
			return redirect('/')->withErrors($errors);
		}
		if($id == Auth::user()->id){
			$errors = array();
			$errors[] = "Anda tidak berhak mengakses halaman berikut.";
			return redirect('/')->withErrors($errors);
		}
		$user = User::find($id);
		return view('crud.edit', compact('user'));
	}

	function create()

	{
		return view('crud.create');
	}


	function destroy($id)
	{		
		User::find($id)->delete();

        return redirect('user')->with('message', 'Data berhasil dihapus!');
	}


	public function update($id, Request $request)
    {
		$user = User::findOrFail($id);

		$input = array_except(Input::all(), '_method');

		$rules = array(
		'username' => 'required|unique:users,username',

		'email' => 'required',

		 );
		$validator = Validator::make($input, $rules);
		if($validator->passes()){

			$user->update($input);

			return redirect('user');
		}
		else{
			return view('crud.edit', compact('user'))
					->withErrors($validator);
		}
    }


    //buat update reset password
    public function updatess($id, Request $request)
    {
		$user = User::findOrFail($id);

		$input = array_except(Input::all(), '_method');

		$rules = array(

			'password' => 'required|min:6',
			'password_confirmation' => 'required|min:6|same:password'
			 );
		$validator = Validator::make($input, $rules);
		if($validator->passes()){

			$user->password = bcrypt(Input::get('password'));
			$user->save();

			return redirect('user')->with('message','Password berhasil di reset!');
		}
		else{
			return view('crud.reset', compact('user'))
					->withErrors($validator);
		}
    }
   
    
    function resets($id)
    {
        $user = User::find($id);

        return view('crud.reset', compact('user'));
    }

     
    function show($id)
	{
		$user = User::find($id);

        return view('user.show', compact('user'));
	}


	function store()

	{

		$data = Input::all();

         $rules = array(
        'username' => 'required|unique:users,username',
        'email' => 'required',
        'password' => 'required|min:6',
        'password_confirmation' => 'required|min:6|same:password'
         );

    
        $validator = Validator::make($data, $rules);

        if($validator->passes()){

        $user = new User;
        $user->username    = Input::get('username');
        $user->email    = Input::get('email');
        $user->auth_level    = Input::get('auth_level');
        $user->is_aktif  = Input::get('is_aktif');
        $user->password = bcrypt(Input::get('password'));
        $user->save();

	   return redirect('user')->with('message','Data berhasil di tambahkan!');
        }
        else{
        	return view('crud.create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));

      
	    
	   }
	  }
}
