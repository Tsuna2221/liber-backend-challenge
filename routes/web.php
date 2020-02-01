<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Task Routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', "Web\RouteController@index");
    Route::post("/event", "Web\EventController@create");
    Route::post("/event/copy/{id}", "Web\EventController@copyTo");
    Route::post("/event/{id}", "Web\EventController@update");
    Route::delete("/event/{id}", "Web\EventController@delete");  
});

//User Routes
Route::group(['middleware' => ['web']], function () {
    Route::get("/login", function(){
        return view("forms/login");
    })->name("login");
    
    Route::get("/register", function(){
        return view("forms/register");
    })->name('register');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect("/");
    })->name("logout");    
});

//Autorization Routes
Route::post("/login", "Web\UserController@login");
Route::post("/register", "Web\UserController@register");
