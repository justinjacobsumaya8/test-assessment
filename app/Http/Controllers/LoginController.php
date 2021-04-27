<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
	public function token()
	{
	    return csrf_token(); 
	}

	public function login()
	{
	    return 'Login First'; 
	}

    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    	    // 'email' => 'required|email',
    	    'username' => 'required',
    	    'password' => 'required',
    	]);

    	$response = array(
    		'success' => false,
    		'error' => []
    	);

    	if ($validator->passes()) 
    	{
    		$user_data = array(
		        'username'     => $request->input('username'),
		        'password'  => $request->input('password')
		    );

    		if (auth()->attempt($user_data,true))
    		{
    			$response['success'] = true;
    		}
    		else
    		{
    			$response['success'] = false;
    			$response['error'] = ['username' => 'These credentials do not match our records.'];
    		}

    		return response()->json($response);
    	}

    	return response()->json(['error' => $validator->errors()->all()]);
    }
}
