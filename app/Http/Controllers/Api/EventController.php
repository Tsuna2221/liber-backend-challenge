<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Event;

class EventController extends Controller
{
    public function create(Requests\EventCreateRequest $request){
        $validatedEvent            = $request->validated();
        $validatedEvent["user_id"] = auth()->user()->id; //Set user_id

        $newEvent = Event::create($validatedEvent); //Create new event

        return response($newEvent);
    }

    public function read(Request $request){
        $id = $request["id"];

        $events = ($id ? //If id exists, return a single event where id match, if not return all users' events 
            Event::where([
                ["id", $id],
                ["user_id", auth()->user()->id]
            ])->first()
        :
            Event::where("user_id", auth()->user()->id)->get()
        );

        if(!$events){
            return response(["message" => "Event not found"], 422);
        }

        return response($events);
    }

    public function update(Requests\EventAPIUpdateRequest $request){
        $eventId = $request["id"];
        
        $event = Event::where([
            ["id", $eventId],
            ["user_id", auth()->user()->id]
        ])->first();

        if(!$event){
            return response(["message" => "Event not found"], 422);
        }

        $event->update($request->all());
        $event->save();
        
        return response($event);

    }

    public function delete(Request $request){
        $eventId = $request["id"];

        $event = Event::where([
            ["id", $eventId],
            ["user_id", auth()->user()->id]
        ])->first();

        if(!$event){
            return response(["message" => "Event not found"], 422);
        }

        $event->delete();
        
        return response($event);
    }

    public function copyTo(Requests\EventCopyRequest $request){
        $eventId = $request["id"];

        $oldEvent = Event::where([
            ["id", $eventId],
            ["user_id", auth()->user()->id]
        ])->first();

        if(!$oldEvent){
            return response(["message" => "Event not found"], 422);
        }

        $newEvent = Event::create([
            "title"       => $oldEvent->title,
            "description" => $oldEvent->description,
            "date"        => $request->validated()["date"],
            "user_id"     => auth()->user()->id
        ]);

        return response($newEvent);
    }  
}
