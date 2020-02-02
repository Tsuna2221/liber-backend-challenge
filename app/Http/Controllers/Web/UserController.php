<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    public function register(Requests\UserRegisterRequest $request){
        $validatedData = $request->validated();       
        $validatedData["password"] = bcrypt($validatedData["password"]); // Encrypt password
        $newUser = User::create($validatedData); //Store in database
 
        //Log newly created user 
        auth()->attempt($request->validated());

        return redirect("/")->with("user", auth()->user());
    }

    public function login(Requests\UserLoginRequest $request){
        if(!auth()->attempt($request->validated())){
            return redirect('/login')->withErrors(["Invalid credentials or user doesn't exist"]);
        }

        return redirect("/")->with("user", auth()->user());
    }
}