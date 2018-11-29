<?php

namespace App\Http\Controllers\Admin\About;

use App\Timeline;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimelineController extends Controller
{
	public function index()
    {
        return view('admin.about.timeline');
    }

    public function loadTimelines()
    {
        $timelines = Timeline::orderBy('date', 'ASC')->get();

        foreach($timelines as $timeline){
        	$timeline->dateReal = $timeline->date;
        	$timeline->date = Carbon::parse($timeline->date)->format('F jS, Y');
        	$timeline->desc = $timeline->description;
        }

    	return $timelines;
    }

    public function store(Request $request){

        $timeline = new Timeline;

        $timeline->title = $request->title;
        $timeline->date = $request->dateReal;
        $timeline->description = $request->desc;

        $timeline->save();

        return response()->json([
            'id' => $timeline->id,
            'title' => $timeline->title,
            'dateReal' => $timeline->date,
            'date' => Carbon::parse($timeline->date)->format('F jS, Y'),
            'desc' => $timeline->description,
        ]);
    }

    public function update(Request $request, Timeline $timeline){

        $timeline->title = $request->title;
        $timeline->date = $request->dateReal;
        $timeline->description = $request->desc;

        $timeline->update();

        return response()->json([
            'id' => $timeline->id,
            'title' => $timeline->title,
            'dateReal' => $timeline->date,
            'date' => Carbon::parse($timeline->date)->format('F jS, Y'),
            'desc' => $timeline->description,
        ]);
    }

    public function destroy(Timeline $timeline){
        $timeline->delete();
    }
}
