<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request){
        $validatedData = $request->validate([ //Validate request data 
            "name"     => "required|string",
            "email"    => "required|email|unique:users",
            "password" => "required|confirmed"
        ]);
        
        $validatedData["password"] = bcrypt($validatedData["password"]); // Encrypt password
        
        $newUser = User::create($validatedData); //Store in database

        //Log newly created user 
        auth()->attempt($validatedData);

        return redirect("/")->with("user", auth()->user());
    }

    public function login(Request $request){
        $loginData = $request->validate([
            "email"    => "required|email",
            "password" => "required"
        ]);

        if(!auth()->attempt($loginData)){ //In case of wrong credentials, redirect with an error
            return redirect('/login')->withErrors(["Invalid Credentials"]);
        }

        return redirect("/")->with("user", auth()->user());
    }
}
