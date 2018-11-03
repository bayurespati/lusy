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

        $subCategories = [];

        foreach($categories as $keys => $category){
            foreach($category->subcategories as $key => $subcategory){
                array_push($subCategories, $subcategory);
            }
        }

    	return [$event,$categories,$subCategories];
    }

    public function store(Request $request){

        $event = new Event;

        $event->sub_category_id = $request->sub_category_id;
        $event->title = $request->title;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->location = $request->location;
        $event->address = $request->address;
        $event->content = $request->content;
        $event->organiser = $request->organiser;

        $event->save();
    }

    public function update(Request $request, Event $event){

        dd(
            $event->id,
            $request->title,
            $request->start_date,
            $request->end_date,
            $request->location,
            $request->address,
            $request->content,
            $request->sub_category_id,
            $request->organiser
        );

    }

    public function destroy(){

    }
}
