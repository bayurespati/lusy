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
        $upcomingEvents = Event::whereDate('end_date', '>=', Carbon::today()->toDateString())->orderBy('end_date', 'DESC')->paginate(6);
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

            $event->day = $startDate->format('l');
            $event->dayDate = $startDate->format('d');
            $event->month = $startDate->format('M');
            $event->startHour = $startDate->format('h:i A');
            $event->endHour = $endDate->format('h:i A');
            $event->endDay = $endDate->format('l');
            $event->year = $endDate->format('Y');
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

        $sortedEvent = $event->images->sortByDesc('type');

        $startDate = Carbon::parse($event->start_date);
        $endDate = Carbon::parse($event->end_date);

        $event->day = $startDate->format('l');
        $event->dayDate = $startDate->format('d');
        $event->month = $startDate->format('M');
        $event->startHour = $startDate->format('h:i A');
        $event->endHour = $endDate->format('h:i A');
        $event->endDay = $endDate->format('l');
        $event->year = $endDate->format('Y');

        $event->isUpcoming = $endDate >= Carbon::today()->toDateString();

        return view('event.single', compact('sosmed', 'event', 'eventBanner', 'sortedEvent'));
    }


    public function getSingleImage(Event $event){
        $images = $event->images()->whereIsPoster(false)->paginate(8);

        $imagesSorted[0] = $images;
        $imagesSorted[1] = [];

        foreach ($images->sortByDesc('type') as $photo) {
            $photo->description = $photo->description == NULL
            ? ""
            : $photo->description;

            array_push($imagesSorted[1], $photo);
        }
    	return $imagesSorted;
    }


    public function getAllpast(Request $request){
    	$events = Event::where('end_date', '<', Carbon::today()->toDateString())
        ->when($request->keyword, function ($query) use ($request){
            $query->whereRaw('LOWER(title) LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '<', Carbon::today()->toDateString())
            ->orWhereRaw('LOWER(location) LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '<', Carbon::today()->toDateString())
            ->orWhereRaw('LOWER(address) LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '<', Carbon::today()->toDateString())
            ->orWhereRaw('LOWER(content) LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '<', Carbon::today()->toDateString())
            ->orWhereRaw('LOWER(organiser) LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '<', Carbon::today()->toDateString())
            ->orWhereRaw('DATE_FORMAT(start_date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '<', Carbon::today()->toDateString())
            ->orWhereRaw('DATE_FORMAT(end_date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '<', Carbon::today()->toDateString());
        })->orderBy('end_date', 'DESC')->paginate(6);

        $events->appends($request->only('keyword'));

        foreach ($events as $event) {
            $event->content = str_limit($event->content, 300);

            $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;
            $event->poster = $event->poster()->get()->isEmpty()
            ? '/img/events1.jpg'
            : $event->poster()->get()[0]->image_path;

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

        return $events;
    }


    public function getAllUpcoming(Request $request){
        $events = Event::where('end_date', '>=', Carbon::today()->toDateString())
        ->when($request->keyword, function ($query) use ($request){
            $query->whereRaw('LOWER(title) LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '>=', Carbon::today()->toDateString())
            ->orWhereRaw('LOWER(location) LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '>=', Carbon::today()->toDateString())
            ->orWhereRaw('LOWER(address) LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '>=', Carbon::today()->toDateString())
            ->orWhereRaw('LOWER(content) LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '>=', Carbon::today()->toDateString())
            ->orWhereRaw('LOWER(organiser) LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '>=', Carbon::today()->toDateString())
            ->orWhereRaw('DATE_FORMAT(start_date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '>=', Carbon::today()->toDateString())
            ->orWhereRaw('DATE_FORMAT(end_date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '>=', Carbon::today()->toDateString());
        })->orderBy('end_date', 'DESC')->paginate(6);

        $events->appends($request->only('keyword'));

        foreach ($events as $event) {
            $event->content = str_limit($event->content, 300);

            $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;
            $event->poster = $event->poster()->get()->isEmpty()
            ? '/img/events1.jpg'
            : $event->poster()->get()[0]->image_path;

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

        return $events;
    }


    public function getPastSubcategory(Request $request, SubCategory $subcategory){
        $events = Event::whereSubCategoryId($subcategory->id)
        ->where('end_date', '<', Carbon::today()->toDateString())
        ->when($request->keyword, function ($query) use ($request, $subcategory){
            $query->whereRaw('LOWER(title) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id)
                ->where('end_date', '<', Carbon::today()->toDateString())
            ->orWhereRaw('LOWER(location) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id)
                ->where('end_date', '<', Carbon::today()->toDateString())
            ->orWhereRaw('LOWER(address) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id)
                ->where('end_date', '<', Carbon::today()->toDateString())
            ->orWhereRaw('LOWER(content) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id)
                ->where('end_date', '<', Carbon::today()->toDateString())
            ->orWhereRaw('LOWER(organiser) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id)
                ->where('end_date', '<', Carbon::today()->toDateString())
            ->orWhereRaw('DATE_FORMAT(end_date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id)
                ->where('end_date', '<', Carbon::today()->toDateString())
            ->orWhereRaw('DATE_FORMAT(start_date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id)
                ->where('end_date', '<', Carbon::today()->toDateString());
        })->orderBy('end_date', 'DESC')->paginate(6);

        $events->appends($request->only('keyword'));

        foreach ($events as $event) {
            $event->content = str_limit($event->content, 300);

            $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;
            $event->poster = $event->poster()->get()->isEmpty()
            ? '/img/events1.jpg'
            : $event->poster()->get()[0]->image_path;

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

        return $events;
    }


    public function getUpcomingSubcategory(Request $request, SubCategory $subcategory){
        $events = Event::whereSubCategoryId($subcategory->id)
        ->where('end_date', '>=', Carbon::today()->toDateString())
        ->when($request->keyword, function ($query) use ($request, $subcategory){
            $query->whereRaw('LOWER(title) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id)
                ->where('end_date', '>=', Carbon::today()->toDateString())
            ->orWhereRaw('LOWER(location) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id)
                ->where('end_date', '>=', Carbon::today()->toDateString())
            ->orWhereRaw('LOWER(address) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id)
                ->where('end_date', '>=', Carbon::today()->toDateString())
            ->orWhereRaw('LOWER(content) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id)
                ->where('end_date', '>=', Carbon::today()->toDateString())
            ->orWhereRaw('LOWER(organiser) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id)
                ->where('end_date', '>=', Carbon::today()->toDateString())
            ->orWhereRaw('DATE_FORMAT(start_date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id)
                ->where('end_date', '>=', Carbon::today()->toDateString())
            ->orWhereRaw('DATE_FORMAT(end_date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id)
                ->where('end_date', '>=', Carbon::today()->toDateString());
        })->orderBy('end_date', 'DESC')->paginate(6);

        $events->appends($request->only('keyword'));

        foreach ($events as $event) {
            $event->content = str_limit($event->content, 300);

            $event->kategori = SubCategory::find($event->sub_category_id)->category()->get()[0]->title;
            $event->poster = $event->poster()->get()->isEmpty()
            ? '/img/events1.jpg'
            : $event->poster()->get()[0]->image_path;

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
