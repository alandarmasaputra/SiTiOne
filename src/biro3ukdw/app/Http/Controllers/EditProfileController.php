<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;


class EditProfileController extends Controller
{
	

	public function index()
	{
		$user = Auth::user();
		return view('editprofile', compact('user'));
	}

	public function lempar(){
		return view('crud.edit');
	}

}