<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
	public function login()
	{ 
		return view('auth.login');
		# code...
	}

	public function postlogin(Request $request)
	{
		# code..
		// printf($request->$email,$request->$password );
		if(Auth::attempt($request->only('email','password'))){
			return redirect('/dashboard');
		}
		return redirect('/login');
	}
    //
    public function logout()
    {
    	# code...
    	Auth::logout();
    	return redirect('/login');
    }
}
