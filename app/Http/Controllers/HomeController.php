<?php

namespace App\Http\Controllers;

use App\Sosmed;
use App\imageSlider;
use App\AboutContent;
use App\ShopItem;
use App\Gallery;
use App\ImageConfig;
use App\Event;
use App\SubCategory;
use App\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sosmed = Sosmed::all();
	    $imageSlider = imageSlider::all();
	    $introduction = AboutContent::where('is_class', '=', false)->get();
	    $shopItems = ShopItem::whereIsShowcase(true)->get();
	    $showcasedImage = Gallery::whereIsShowcase(true)->get();
	    $eventBanner = ImageConfig::find(1)->image_path === null 
	    ? '/img/upcoming-event-bg.jpg'
	    : ImageConfig::find(1)->image_path;

	    $introduction[0]->content = str_limit($introduction[0]->content, 300);

	    foreach ($shopItems as $item) {
	            $item->poster = $item->poster()->get()->isEmpty()
	            ? '/img/welcome-1.jpg'
	            : $item->poster()->get()[0]->image_path;

	            $item->price = number_format($item->price, 2, ",", ".");
	        }

	    if(
	        count($showcasedImage) > 0 && 
	        count($showcasedImage) >= 4 && count($showcasedImage) < 8){
	        $showedImage = Gallery::whereIsShowcase(true)->paginate(4); 
	    }
	    else {
	        $showedImage = $showcasedImage;
	    }

	    $showcasedEvents = Event::orderBy('end_date', 'DESC')->paginate(2);

	    foreach ($showcasedEvents as $event) {
	        $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;

	        $startDate = Carbon::parse($event->start_date);
	        $endDate = Carbon::parse($event->end_date);

	        $event->day = $startDate->format('D');
	        $event->dayComplete = $startDate->format('l');
	        $event->dayDate = $startDate->format('d');
	        $event->month = $startDate->format('M');
	        $event->startHour = $startDate->format('h:i A');
	        $event->endHour = $endDate->format('h:i A');
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

	    return view('index')->with(compact('sosmed', 'imageSlider', 'introduction', 'shopItems', 'showedImage', 'showcasedEvents', 'eventBanner', 'achievements'));
    }


    public function addMember(Request $request){

    	$date = explode('/', str_replace(' ', '', $request->date_of_birth) );
	    $date_of_birth = $date[2].'-'.$date[0].'-'.$date[1];

	    $member = new Member;
	    $member->name = $request->name;
	    $member->gender = $request->gender;
	    $member->place_of_birth = $request->place_of_birth;
	    $member->date_of_birth = $date_of_birth;

	    $member->email = $request->email;
	    $member->telephone = $request->telephone;
	    $member->mobile = $request->mobile;
	    $member->fax = $request->fax;

	    $member->is_approve = false;
	    $member->is_active = false;
	    $member->class_id = $request->class_id;
	    $member->save();

	    return back();
    }
}
