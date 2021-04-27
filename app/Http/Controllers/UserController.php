<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use \App\Models\User;

class UserController extends Controller
{
    public function update(Request $request, $id)
    {
    	// $request->validate([
    	//     'name' => 'required',
    	//     'username' => 'required|min:4|max:20',
    	//     'email' => 'required|email|unique:users,email,'.$id,
    	//     'avatar' => 'dimensions:width=256,height=256'
    	// ]);

    	// validators not working in postman

    	$email_exist = User::where('email', $request->email)->where('id', '!=', $id)->count();
    	if ($email_exist) 
    	{
    		return response()->json(['message' => 'Email already exist']);
    	}

    	$user = User::findOrFail($id);
    	$user->name = $request->name;
    	$user->username = $request->username;
    	$user->email = $request->email;
    	$user->save();
    	
    	$avatar = $request->file('avatar');
    	if ($avatar) 
    	{
			$user_photo = $avatar->store('uploads/user');
            $user->avatar = $user_photo;
            $user->save();
    	}

    	return response()->json(['message' => 'Profile updated successfully.']);
    }
}
