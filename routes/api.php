<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//User Routes
Route::post("/login", "Api\UserController@login");
Route::post("/register", "Api\UserController@register");

//Event Routes
Route::group(['middleware' => ['auth:api']], function(){
    Route::get('/event/{id?}', "Api\EventController@read");
    Route::post("/event", "Api\EventController@create");
    Route::put("/event/{id}", "Api\EventController@update");
    Route::post("/event/copy/{id}", "Api\EventController@copyTo");
    Route::delete("/event/{id}", "Api\EventController@delete");  
});