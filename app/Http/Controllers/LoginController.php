<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
    	$tmpUser = User::where([
    				'email' => $request->email,
    				'is_active' => 1
    		])->first();
    	if (!is_null($tmpUser)) {
    		if (Auth::attempt([
    		'email' => $request->email,
    		'password' => $request->password
    		])) {
	    		$user = User::where([
	    					'email' => $request->email,
	    					'is_active' => 1
	    				])->first();
				if ($user->role->level == 1) {
	    			return redirect()->route('admin');
	    		}
	    		return redirect()->route('user');
		    }
	    	return redirect()->back()->with('message', 'Maaf Kombinasi email dan password tidak sesuai');
    	}
	    return redirect()->back()->with('message', 'Maaf kami tidak dapat menemukan akun anda!');
    }


    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }
}
