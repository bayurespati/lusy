<?php

namespace App\Http\Controllers\Event;

use App\Sosmed;
use App\Category;
use App\Event;
use App\ImageConfig;
use App\SubCategory;
use App\ApplicantList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index(){

    	$sosmed = Sosmed::all();
        $categories = Category::with('subcategories')->whereType(2)->get();
        $upcomingEvents = Event::whereDate('end_date', '>=', Carbon::today()->toDateString())->paginate(6);
        $eventBanner = ImageConfig::find(4)->image_path === null 
        ? '/img/page-banner-bg.jpg'
        : ImageConfig::find(4)->image_path;

        $isEventsExist = count(Event::all()) > 0 
        ? true 
        : false;

        foreach ($upcomingEvents as $event) {
            $event->content = str_limit($event->content, 300);
            $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;
            $event->poster = $event->poster()->get()->isEmpty()
            ? '/img/events1.jpg'
            : $event->poster()->get()[0]->image_path;

            $startDate = Carbon::parse($event->start_date);
            $endDate = Carbon::parse($event->end_date);

            $event->day = $startDate->format('D');
            $event->dayDate = $startDate->format('d');
            $event->month = $startDate->format('M');
            $event->startHour = $startDate->format('h:i A');
            $event->endHour = $endDate->format('h:i A');
        }

		return view('event.index', compact('sosmed', 'categories', 'upcomingEvents', 'isEventsExist', 'eventBanner'));
    }


    public function getSingle(Event $event){

    	$sosmed = Sosmed::all();

        $eventBanner = ImageConfig::find(4)->image_path === null 
        ? '/img/page-banner-bg.jpg'
        : ImageConfig::find(4)->image_path;

        $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;

        $event->poster = $event->poster()->get()->isEmpty()
        ? '/img/events1.jpg'
        : $event->poster()->get()[0]->image_path;

        $event->images = $event->images()->whereIsPoster(false)->paginate(8);

        $startDate = Carbon::parse($event->start_date);
        $endDate = Carbon::parse($event->end_date);

        $event->day = $startDate->format('D');
        $event->dayDate = $startDate->format('d');
        $event->month = $startDate->format('M');
        $event->startHour = $startDate->format('h:i A');
        $event->endHour = $endDate->format('h:i A');

        $event->isUpcoming = $endDate >= Carbon::today()->toDateString();

        return view('event.single', compact('sosmed', 'event', 'eventBanner'));
    }


    public function getSingleImage(Event $event){
    	return $event->images()->whereIsPoster(false)->paginate(8);
    }


    public function getAllpast(){

    	$events = Event::whereDate('end_date', '<', Carbon::today()->toDateString())->paginate(6);

        foreach ($events as $event) {
            $event->content = str_limit($event->content, 300);

            $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;
            $event->poster = $event->poster()->get()->isEmpty()
            ? '/img/events1.jpg'
            : $event->poster()->get()[0]->image_path;

            $startDate = Carbon::parse($event->start_date);
            $endDate = Carbon::parse($event->end_date);

            $event->day = $startDate->format('D');
            $event->dayDate = $startDate->format('d');
            $event->month = $startDate->format('M');
            $event->startHour = $startDate->format('h:i A');
            $event->endHour = $endDate->format('h:i A');
        }

        return $events;
    }


    public function getAllUpcoming(){

    	$events = Event::whereDate('end_date', '>=', Carbon::today()->toDateString())->paginate(6);

        foreach ($events as $event) {
            $event->content = str_limit($event->content, 300);

            $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;
            $event->poster = $event->poster()->get()->isEmpty()
            ? '/img/events1.jpg'
            : $event->poster()->get()[0]->image_path;

            $startDate = Carbon::parse($event->start_date);
            $endDate = Carbon::parse($event->end_date);

            $event->day = $startDate->format('D');
            $event->dayDate = $startDate->format('d');
            $event->month = $startDate->format('M');
            $event->startHour = $startDate->format('h:i A');
            $event->endHour = $endDate->format('h:i A');
        }

        return $events;
    }


    public function getPastSubcategory(SubCategory $subcategory){

    	$events = Event::whereDate('end_date', '<', Carbon::today()->toDateString())->whereSubCategoryId($subcategory->id)->paginate(6);

        foreach ($events as $event) {
            $event->content = str_limit($event->content, 300);

            $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;
            $event->poster = $event->poster()->get()->isEmpty()
            ? '/img/events1.jpg'
            : $event->poster()->get()[0]->image_path;

            $startDate = Carbon::parse($event->start_date);
            $endDate = Carbon::parse($event->end_date);

            $event->day = $startDate->format('D');
            $event->dayDate = $startDate->format('d');
            $event->month = $startDate->format('M');
            $event->startHour = $startDate->format('h:i A');
            $event->endHour = $endDate->format('h:i A');
        }

        return $events;
    }


    public function getUpcomingSubcategory(SubCategory $subcategory){

    	$events = Event::whereDate('end_date', '>=', Carbon::today()->toDateString())->whereSubCategoryId($subcategory->id)->paginate(6);

        foreach ($events as $event) {
            $event->content = str_limit($event->content, 300);

            $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;
            $event->poster = $event->poster()->get()->isEmpty()
            ? '/img/events1.jpg'
            : $event->poster()->get()[0]->image_path;

            $startDate = Carbon::parse($event->start_date);
            $endDate = Carbon::parse($event->end_date);

            $event->day = $startDate->format('D');
            $event->dayDate = $startDate->format('d');
            $event->month = $startDate->format('M');
            $event->startHour = $startDate->format('h:i A');
            $event->endHour = $endDate->format('h:i A');
        }

        return $events;
    }


    public function registration(Request $request, Event $event){
    	$applicantList = new ApplicantList;

        $applicantList->event_id = $event->id;
        $applicantList->name = $request->name;
        $applicantList->email = $request->email;
        $applicantList->phone = $request->phone;
        $applicantList->is_approve = false;

        $applicantList->save();

        return back();
    }
}
