<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    public function create(Request $request){
        $validatedData = $request->validate([
            "title"       => "required",
            "description" => "max:100",
            "date"        => "required"
        ]);

        $validatedData["user_id"] = auth()->user()->id;

        $newEvent = Event::create($validatedData);

        return back();
    }

    public function update(Request $request){
        $eventId = $request["id"];

        $validatedData = $request->validate([
            "title"       => "required",
            "description" => "max:100",
            "date"        => "required"
        ]);

        $event = Event::where([
            ["id", $eventId],
            ["user_id", auth()->user()->id]
        ])->firstOrFail();

        $event->update($request->all());
        $event->save();

        return back();
    }

    public function delete(Request $request){
        $eventId = $request["id"];
        
        $event = Event::where([
            ["id", $eventId],
            ["user_id", auth()->user()->id]
        ])->firstOrFail();

        $event->delete();
        
        return back();
    }
    
    public function copyTo(Request $request){
        $eventId = $request["id"];
        
        $validatedData = $request->validate([
            "date" => "required"
        ]);

        $oldEvent = Event::where([
            ["id", $eventId],
            ["user_id", auth()->user()->id]
        ])->firstOrFail();

        $newEvent = Event::create([
            "title"       => $oldEvent->title,
            "description" => $oldEvent->description,
            "date"        => $request->date,
            "user_id"     => auth()->user()->id
        ]);

        return back();
    }
}
