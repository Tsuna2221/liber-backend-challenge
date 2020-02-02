<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    public function login(Requests\UserLoginRequest $request){
        if(!auth()->attempt($request->validated())){ //If login attempt fails, also return an error message
            return response([
                "message" => "Invalid credentials or user doesn't exist",
            ], 400);
        }

        $user = auth()->user();
        $accessToken = $user->createToken("authToken")->accessToken; //Create access token

        return response(["data" => $user, "access_token" => $accessToken]);
    }

    public function register(Requests\UserRegisterRequest $request){
        $validatedUser             = $request->validated();
        $validatedUser["password"] = bcrypt($validatedUser["password"]);

        $newUser = User::create($validatedUser);
        $accessToken = $newUser->createToken("authToken")->accessToken;

        return response(["data" => $newUser, "access_token" => $accessToken]);
    }
}