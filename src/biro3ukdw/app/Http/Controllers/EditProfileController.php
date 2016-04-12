<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;


class EditProfileController extends Controller
{
	

	public function index()
	{
		
		return view('editprofile');
	}

}