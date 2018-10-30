<?php

namespace App\Http\Controllers\Admin\Event;

use App\Event;
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
    	return Event::all();
    }

    public function patch(Request $request, Event $event){

    }
}
