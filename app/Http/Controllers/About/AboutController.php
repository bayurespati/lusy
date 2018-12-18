<?php

namespace App\Http\Controllers\About;

use App\Sosmed;
use App\AboutContent;
use App\ImageConfig;
use App\Gallery;
use App\Event;
use App\Member;
use App\Timeline;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index(){
    	$sosmed = Sosmed::all();
        $about = AboutContent::where('is_class', '=', false)->get();
        $classes = AboutContent::where('is_class', '=', true)->get();
        $timelines = Timeline::orderBy('date', 'ASC')->get();

        foreach($timelines as $timeline){
            $timeline->year = Carbon::parse($timeline->date)->format('Y');
            $timeline->dataDate = Carbon::parse($timeline->date)->format('d/m/Y');
            $timeline->dateHeader = Carbon::parse($timeline->date)->format('F jS, Y');
            $timeline->date = Carbon::parse($timeline->date)->format('j M');
            $timeline->desc = $timeline->description;
        }

        $showcasedImage = Gallery::whereIsShowcase(true)->orderBy('type', 'DESC')->get();

        if(
            count($showcasedImage) > 0 && 
            count($showcasedImage) >= 4 && count($showcasedImage) < 8){
            $showedImage = Gallery::whereIsShowcase(true)->orderBy('type', 'DESC')->paginate(4); 
        }
        else {
            $showedImage = $showcasedImage;
        }

		return view('about.index', compact('sosmed', 'about', 'classes', 'showedImage', 'timelines'));
    }
}
