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
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
	    $showcasedImage = Gallery::whereIsShowcase(true)->orderBy('type', 'DESC')->get();
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
	        $showedImage = Gallery::whereIsShowcase(true)->orderBy('type', 'DESC')->paginate(4); 
	    }
	    else {
	        $showedImage = $showcasedImage;
	    }

	    $showcasedEvents = Event::orderBy('end_date', 'DESC')->paginate(2);

	    foreach ($showcasedEvents as $event) {
	        $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;

	        $startDate = Carbon::parse($event->start_date);
	        $endDate = Carbon::parse($event->end_date);

	        $event->day = $startDate->format('l');
            $event->dayDate = $startDate->format('d');
            $event->month = $startDate->format('M');
            $event->startHour = $startDate->format('h:i A');
            $event->endHour = $endDate->format('h:i A');
            $event->endDay = $endDate->format('l');
            $event->year = $endDate->format('Y');
	    }

	    return view('index')->with(compact('sosmed', 'imageSlider', 'introduction', 'shopItems', 'showedImage', 'showcasedEvents', 'eventBanner'));
    }


    public function addMember(Request $request){

    	$validator = Validator::make($request->all(),
    		array('email'  => 'required|email|unique:members',)
        );

		if(!$validator->fails()){

			DB::transaction(function () use ($request) {

				$date = explode('/', str_replace(' ', '', $request->date_of_birth) );
			    $date_of_birth = $date[2].'-'.$date[0].'-'.$date[1];

			    $member = new Member;
			    $member->name = $request->name;
			    $member->gender = $request->gender;
			    $member->place_of_birth = $request->place_of_birth;
			    $member->date_of_birth = $date_of_birth;
			    $member->address = $request->address;

			    $member->email = $request->email;
			    $member->telephone = $request->telephone;
			    $member->mobile = $request->mobile;
			    $member->fax = $request->fax;

			    $member->is_teacher = false;
			    $member->is_active = false;
			    $member->save();

			    $member->class()->attach($request->class_id, ['is_approve' => false]);

		    });

		}else{

			$alradyHasClass = false;

			$member = Member::where('email', $request->email)->with('class')->first();

			foreach ($member->class as $class) {
				if($class['pivot']->class_id == (int) $request->class_id){
					$alradyHasClass = true;
				}
			}

			if(!$alradyHasClass){
				$member->class()->attach($request->class_id, ['is_approve' => false]);
			}else{
				return back();
			}
		}
    	
	    return back();
    }
}
