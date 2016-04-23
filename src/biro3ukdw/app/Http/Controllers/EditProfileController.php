<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use App\UserAddition;
use App\AppUtility;
use Intervention\Image\Facades\Image as Intervention;



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
        $user_name = trim($input['display_name']);
       
        $newUser = Auth::user();
        $newUserAddition = new UserAddition();
		$newUserAddition->user_id = $newUser->id;
                 
        //check if header picture exist
        if($request->hasFile('foto')){
            try{
                $file = $request->file('foto');

                //make image
                $image = Intervention::make($file);

                //make filename
                $extension = AppUtility::image_mime_to_extension($image->mime()); 
                $filename = 'dp_';
                $filename .= AppUtility::get_random_name('');
                $filename .= $extension;

                //compress image
                $image = AppUtility::compress_image($image);
				$deletables[$newUserAddition->display_pic] = false;
				$deletables[$filename] = true;
                //Save Image filename
                $newUserAddition->display_pic = $filename;

                //Save Image
                AppUtility::save_image($filename,$image);
            }catch(\Exception $e){
                $errors[] = "Terjadi kesalahan saat mengupload gambar.";
            }
        }
		else{
			if(isset($input['foto-old']) && trim($input['foto-old'])!=''){
				$filename = $input['foto-old'];
				$newUserAddition->display_pic = $filename;
				$deletables[$filename] = true;
			}
		}
        $newUser->email = $user_email;
        $newUserAddition->jabatan = $user_jabatan;
        $newUserAddition->phone = $user_phone;
        $newUserAddition->display_name = $user_name;
        
        
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