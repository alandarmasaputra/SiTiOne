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

        $successMessage = 'Selamat, User berhasil di hapus !';
            return back()
            ->with('successMessage',$successMessage);
	}


	public function update($id, Request $request)
    {
		$user = User::findOrFail($id);

		$input = array_except(Input::all(), '_method');

		$rules = array(
		'username' => 'required|unique:users,username,'.$user->username.',username',

		'email' => 'required',

		 );
		$validator = Validator::make($input, $rules);
		if($validator->passes()){

			$user->update($input);

			$successMessage = 'Selamat, User berhasil di update !';
            return back()
            ->with('successMessage',$successMessage);
		}
		else{
			return back()
					->withErrors($validator);
		}
    }


    //buat update reset password
    public function updatess($id, Request $request)
    {
		$user = User::findOrFail($id);

		$input = array_except(Input::all(), '_method');

		$rules = array(

			'password' => 'required|min:8',
			'password_confirmation' => 'required|min:8|same:password'
			 );
		$validator = Validator::make($input, $rules);
		if($validator->passes()){

			$user->password = bcrypt(Input::get('password'));
			$user->save();

			$successMessage = 'Selamat, Password berhasil di reset !';
            return back()
            ->with('successMessage',$successMessage);
            

			
		}
		else{
			return back()
					->withErrors($validator);
		}
    }

     public function updateadmin($id, Request $request)
    {
		$user = User::findOrFail($id);

		$input = array_except(Input::all(), '_method');

		$rules = array(

			'password' => 'required|min:8',
			'password_confirmation' => 'required|min:8|same:password'
			 );
		$validator = Validator::make($input, $rules);
		if($validator->passes()){

			$user->password = bcrypt(Input::get('password'));
			$user->save();

			$successMessage = 'Selamat, Password berhasil di reset !';
            return back()
            ->with('successMessage',$successMessage);
            

			
		}
		else{
			return back()
					->withErrors($validator);
		}
    }
   
    
    function resets($id)
    {
        $user = User::find($id);

        return view('crud.reset', compact('user'));
    }

    function resetsadmin($id)
    {
        $user = User::find($id);

        return view('crud.resetadmin', compact('user'));
    }

     

	function store()

	{

		$data = Input::all();

         $rules = array(
        'username' => 'required|unique:users,username',
        'email' => 'required|unique:users,username',
        'password' => 'required|min:8',
        'password_confirmation' => 'required|min:8|same:password'
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

	    $successMessage = 'Selamat, user berhasil di buat !';
            return back()
            ->with('successMessage',$successMessage);
        }
        else{
        	return back()
                ->withErrors($validator)
                ->withInput(Input::except('password'));

      
	    
	   }
	  }
}
