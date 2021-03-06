<?php

namespace App\Http\Controllers\Admin\Event;

use App\Event;
use App\Category;
use App\EventImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function index()
    {
        return view('admin.event.list');
    }

    public function loadEvent()
    {
        $categories = Category::where('type','2')->with('subcategories')->get();
        $event = Event::all();

    	return [$event,$categories];
    }

    public function store(Request $request){
        
        $event = new Event;

        $event->category_id = $request->category_id;
        $event->title = $request->title;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->location = $request->location;
        $event->address = $request->address;
        $event->content = $request->content;
        $event->organiser = $request->organiser;

        $event->save();

        return $event->id;
    }

    public function update(Request $request, Event $event){

        $event->title = $request->title;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->location = $request->location;
        $event->address = $request->address;
        $event->content = $request->content;
        $event->category_id = $request->category_id;
        $event->organiser = $request->organiser;

        $event->update();
    }

    public function destroy(Event $event){
        $event->delete();    
    }
}
