<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;

class UserController extends Controller
{
	function loginpage(){
		
	}

	function index()
	{
		$user = User::all();
		return view('crud.index', compact('user'));
	}

	function create()
	{
		return view('news.new');
	}


	function destroy($id)
	{		
		User::find($id)->delete();

        return redirect('user')->with('message', 'Data berhasil dihapus!');
	}

	function update($id)
	{
		$userUpdate = Request::all();
	    $user = User::find($id);
	    $user->update($userUpdate);
	    return redirect('user')->with('message', 'Data berhasil dirubah!');
	}
     
    function show($id)
	{
		$user = User::find($id);

        return view('user.show', compact('user'));
	}

	function store(CreateUserRequest $request)
	{
	    User::create($request->all());

	    return redirect('user')->with('message', 'Data berhasil ditambahkan!');        	   	
	}
}
