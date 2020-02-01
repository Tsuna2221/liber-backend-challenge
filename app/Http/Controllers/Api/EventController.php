<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [ //Validate request data
            "title"       => "required",
            "description" => "max:100",
            "date"        => "required"
        ]);
        
        if($validator->fails()){ //Check if requets is valid, if is not, return an error message
            return response([
                "message" => "Validation Error",
                "errors"  => $validator->errors()
            ]);
        }

        $validatedEvent            = $validator->valid();
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

    public function update(Request $request){
        $eventId = $request["id"];
        
        $event = Event::where([
            ["id", $eventId],
            ["user_id", auth()->user()->id]
        ])->first();

        $validator = Validator::make($request->all(), [
            "description" => "max:100",
        ]);

        if($validator->fails()){
            return response([
                "message" => "Validation Error",
                "errors"  => $validator->errors()
            ], 400);
        }

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

    public function copyTo(Request $request){
        $eventId = $request["id"];

        $oldEvent = Event::where([
            ["id", $eventId],
            ["user_id", auth()->user()->id]
        ])->first();
        
        $validator = Validator::make($request->all(), [
            "date" => "required"
        ]);

        if($validator->fails()){
            return response([
                "message" => "Validation Error",
                "errors"  => $validator->errors()
            ], 400);
        }

        if(!$oldEvent){
            return response(["message" => "Event not found"], 422);
        }

        $newEvent = Event::create([
            "title"       => $oldEvent->title,
            "description" => $oldEvent->description,
            "date"        => $validator->valid()["date"],
            "user_id"     => auth()->user()->id
        ]);

        return response($newEvent);
    }  
}
