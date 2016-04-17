<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Input;
use Auth;





class UserController extends Controller
{
	function loginpage(){
		
	}

	public function index()
	{
		$user = User::all();
		return view('crud.index', compact('user'));
	}


	function edit($id)
	{
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

    $user->update($input);

    return redirect('user');
}
     
    function show($id)
	{
		$user = User::find($id);

        return view('user.show', compact('user'));
	}

	function store()
	{
	    $user = new User;
        $user->username    = Input::get('username');
        $user->email    = Input::get('email');
        $user->auth_level    = Input::get('auth_level');
        $user->is_aktif  = Input::get('is_aktif');
        $user->password = bcrypt(Input::get('password'));
        $user->save();

    

	   return redirect('user')->with('message','Data berhasil di tambhkan!');
	}
}
