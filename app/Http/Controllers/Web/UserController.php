<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function register(Request $request){
        $validatedData = $request->validate([ //Validate request data 
            "name"     => "required|string",
            "email"    => "required|email|unique:users",
            "password" => "required|confirmed|min:6"
        ]);
        
        $validatedData["password"] = bcrypt($validatedData["password"]); // Encrypt password
        $newUser = User::create($validatedData); //Store in database
 
        $credentials = [ //Since $validatedData's password is encrypted and $request->all() can't be used. Log credentials will be stored separately 
            "email"    => $request->email,
            "password" => $request->password
        ];

        //Log newly created user 
        if(!auth()->attempt($credentials)){ //In case of wrong credentials, redirect with an error
            return redirect('/register')->withErrors(["Invalid credentials"]);
        }

        return redirect("/")->with("user", auth()->user());
    }

    public function login(Request $request){
        $loginData = $request->validate([
            "email"    => "required|email",
            "password" => "required"
        ]);

        if(!auth()->attempt($loginData)){
            return redirect('/login')->withErrors(["Invalid credentials"]);
        }

        return redirect("/")->with("user", auth()->user());
    }
}