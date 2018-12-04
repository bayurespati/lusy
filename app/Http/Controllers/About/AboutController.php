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
        $aboutBanner = ImageConfig::find(2)->image_path === null 
        ? '/img/page-banner-bg.jpg'
        : ImageConfig::find(2)->image_path;

        $timelines = Timeline::orderBy('date', 'ASC')->get();

        foreach($timelines as $timeline){
            $timeline->year = Carbon::parse($timeline->date)->format('Y');
            $timeline->dataDate = Carbon::parse($timeline->date)->format('d/m/Y');
            $timeline->dateHeader = Carbon::parse($timeline->date)->format('F jS, Y');
            $timeline->date = Carbon::parse($timeline->date)->format('j M');
            $timeline->desc = $timeline->description;
        }

        $showcasedImage = Gallery::whereIsShowcase(true)->orderBy('is_wide', 'DESC')->get();

        if(
            count($showcasedImage) > 0 && 
            count($showcasedImage) >= 4 && count($showcasedImage) < 8){
            $showedImage = Gallery::whereIsShowcase(true)->orderBy('is_wide', 'DESC')->paginate(4); 
        }
        else {
            $showedImage = $showcasedImage;
        }

        $events = Event::with('subcategory', 'subcategory.category')->get();
        $exhibitionsCount = 0;
        $classesCount = 0;
        $workshopsCount = 0;

        foreach ($events as $event) {
            if($event->subcategory->category->title === 'Exhibition') {
                $exhibitionsCount++;
            }
            else if($event->subcategory->category->title === 'Classes') {
                $classesCount++;
            }
            else if($event->subcategory->category->title === 'Workshop') {
                $workshopsCount++;
            }
        }

        $achievements = array(
            array(
                'title' => 'Artworks',
                'logo' => 'fa fa-diamond',
                'value' => count(Gallery::all())
            ),
            array(
                'title' => 'Events',
                'logo' => 'fa fa-calendar',
                'value' => $workshopsCount + $exhibitionsCount,
            ),
            array(
                'title' => 'Classes',
                'logo' => 'fa fa-university',
                'value' => $classesCount
            ),
            array(
                'title' => 'Students',
                'logo' => 'fa fa-users',
                'value' => count(Member::whereIsActive(true)->get())
            )
        );

		return view('about.index', compact('sosmed', 'about', 'classes', 'showedImage', 'aboutBanner', 'achievements', 'timelines'));
    }
}
