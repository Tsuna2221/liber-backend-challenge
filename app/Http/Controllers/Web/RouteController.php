<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;

class RouteController extends Controller
{
    public function index(){
        $user_id = auth()->user()->id;
        $eventList = Event::where(["user_id" => $user_id])->get()->reverse();
    
        return view('main', ["events" => $eventList]);
    }    
}
