<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            "email"    => "required|email",
            "password" => "required"
        ]);
        
        if($validator->fails()){  //If validation fails, return an error message 
            return response([
                "message" => "Validation Error",
                "errors"  => $validator->errors()
            ], 400);
        }

        if(!auth()->attempt($validator->valid())){ //If login attempt fails, also return an error message
            return response([
                "message" => "Invalid Credentials",
                "errors"  => $validator->errors()
            ], 400);
        }

        $user = auth()->user();
        $accessToken = $user->createToken("authToken")->accessToken; //Create access token

        return response(["data" => $user, "access_token" => $accessToken]);
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            "name"     => "required|string",
            "email"    => "required|email|unique:users",
            "password" => "required|confirmed|min:6"
        ]);

        if($validator->fails()){
            return response([
                "message" => "Validation Error",
                "errors"  => $validator->errors()
            ], 400);
        }     

        $validatedUser             = $validator->valid();
        $validatedUser["password"] = bcrypt($validatedUser["password"]);

        $newUser = User::create($validatedUser);
        $accessToken = $newUser->createToken("authToken")->accessToken;

        return response(["data" => $newUser, "access_token" => $accessToken]);
    }
}