<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\UserAddition;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'auth_level', 'is_aktif',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	function authlevelstring(){
		$authlevel = $this->auth_level;
		switch($authlevel){
			case 0: return "superadmin";
			case 1: return "admin";
			case 2: return "staff";
			case 3: return "volunteer";
		}
	}
	
	public function addition(){
		return UserAddition::where('user_id',$this->id)->first();
	}
	
	public function clear(){
		$add = UserAddition::where('user_id',$this->id)->get();
		UserAddition::where('user_id',$this->id)->delete();
		return $add;
	}
}
