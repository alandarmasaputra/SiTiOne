<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use App\UserAddition;
use App\AppUtility;



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
	public function editself(Request $request){
		
		
    	$deletables = array();
        $input = $request->all();
                                                       
        $user_email = trim($input['email']);
        $user_jabatan = trim($input['jabatan']);
        $user_phone = trim($input['phone']);
       
        $newUser = Auth::user();
        $newUserAddition = new UserAddition();
		$newUserAddition->user_id = $newUser->id;
         
        $newUser->email = $user_email;
        $newUserAddition->jabatan = $user_jabatan;
        $newUserAddition->phone = $user_phone;
        
        
        /*foreach($oldAddition as $old){
     		if($oldAddition->display_pic){
            	$deletables[$oldAddition->display_pic] = false;
     		}
		}*/
 		$oldAddition = $newUser->clear();
        $newUser->save();

        $newUserAddition->save();
        
	
		AppUtility::unlink_deletables($deletables);
        
   
        $successMessage = 'User berhasil diedit';
        $request->session()->flash('successMessage',$successMessage);
        return redirect(url('/editprofile'));
    }

}