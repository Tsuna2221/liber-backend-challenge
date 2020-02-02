<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Event;

class EventController extends Controller
{
    public function create(Requests\EventCreateRequest $request){
        $validatedData = $request->validated();
        $validatedData["user_id"] = auth()->user()->id;

        $newEvent = Event::create($validatedData);

        return back();
    }

    public function update(Requests\EventCreateRequest $request){
        $eventId = $request["id"];

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
    
    public function copyTo(Requests\EventCopyRequest $request){
        $eventId = $request["id"];

        $oldEvent = Event::where([
            ["id", $eventId],
            ["user_id", auth()->user()->id]
        ])->firstOrFail();

        $newEvent = Event::create([
            "title"       => $oldEvent->title,
            "description" => $oldEvent->description,
            "date"        => $request->validated()["date"],
            "user_id"     => auth()->user()->id
        ]);

        return back();
    }
}
