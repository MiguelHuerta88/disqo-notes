<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserAuthRequest;
use Illuminate\Support\Str;
use App\Http\Resources\User as UserResource;
use Auth;

class AuthController extends Controller
{
	/**
	 * Login
	 *
	 * @return Response
	 */
    public function login()
    {
    	// this will return a response telling the user this route is not valid
    	return response()->json([
    		'data' => [
    			'message' => 'This api route cannot be accessed. Must try post to submit cred to authenticate'
    		]
    	]);
    }

    /**
     * Posts a login.
     *
     * @param      \App\Http\Requests\UserAuthRequest  $request  The request
     *
     * @return Resource
     */
    public function postLogin(UserAuthRequest $request)
    {
    	// by this time we should have all required fields so we can try to authenticate
    	$creds = $request->only('email', 'password');

    	// try to authenticate
    	if (!Auth::attempt($creds)) {
    		return response()->json([
    			'data' => [
    				'message' => 'Email/Password incorrect'
    			]
    		]);
    	}

    	// otherwise we are good. lets set a token and save the record
    	$user = Auth::user();
    	$user->api_token = Str::random(80);
    	$user->save();

    	return new UserResource($user);
    }

    /**
     * Logout function
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function logout()
    {
    	// this route is under the auth middleware so user should be logged in
    	$user = request()->user();

    	if (!$user) {
    		return response()->json([
    			'data' => [
    				'message' => 'Error! You must be authenticated to reach this route'
    			]
    		]);
    	}
    	// otherwise we null out the api_token and save record
    	$user->api_token = null;
    	$user->save();

    	return response()->json([
    			'data' => [
    				'message' => 'User has been logged out. Your token will no longer work'
    			]
    		]);
    }
}
