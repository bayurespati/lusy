<?php

namespace App\Http\Controllers\Event;

use App\Sosmed;
use App\Category;
use App\Event;
use App\ImageConfig;
use App\ApplicantList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    public function index(){

    	$sosmed = Sosmed::all();
        $categories = Category::with('subcategories')->whereType(2)->get();
        $upcomingEvents = Event::whereDate('end_date', '<', Carbon::today()->toDateString())->orderBy('end_date', 'DESC')->paginate(6);
        $isEventsExist = count(Event::all()) > 0 
        ? true 
        : false;

        $currentYear = Carbon::parse(Carbon::now())->format('Y');
        $lowestYear = $currentYear;
        $highestYear = $currentYear;

        foreach ($upcomingEvents as $event) {
            $event->content = str_limit($event->content, 300);
            $event->poster = $event->poster()->get()->isEmpty()
            ? '/img/events1.jpg'
            : $event->poster()->get()[0]->image_path;

            $startDate = Carbon::parse($event->start_date);
            $endDate = Carbon::parse($event->end_date);

            if($startDate == $endDate){
                $event->day = $startDate->format('l');
            }
            else {
                // $event->day = $startDate->format('l') + ' - ' + $endDate->format('l');
            }

            $event->dayDate = $startDate->format('d');
            $event->month = $startDate->format('M');
            $event->year = $endDate->format('Y');
        }

        foreach (Event::all() as $event) {
            $eventYear = Carbon::parse($event->start_date)->format('Y');

            if((int)$eventYear < (int)$lowestYear){
                $lowestYear = $eventYear;
            }

            if((int)$eventYear > (int)$currentYear){
                $highestYear = $eventYear;
            }
        }

		return view('event.index', compact('sosmed', 'categories', 'upcomingEvents', 'isEventsExist', 'lowestYear', 'currentYear', 'highestYear'));
    }


    public function getSingle(Event $event){

    	$sosmed = Sosmed::all();
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
        $event->endDay = $endDate->format('l');
        $event->year = $endDate->format('Y');

        $event->isUpcoming = $endDate >= Carbon::today()->toDateString();

        return view('event.single', compact('sosmed', 'event', 'sortedEvent'));
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
            $query->whereRaw('DATE_FORMAT(start_date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '<', Carbon::today()->toDateString())
            ->orWhereRaw('DATE_FORMAT(end_date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '<', Carbon::today()->toDateString());
        })->orderBy('end_date', 'DESC')->paginate(6);

        $events->appends($request->only('keyword'));

        foreach ($events as $event) {
            $event->content = str_limit($event->content, 300);

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
            $query->whereRaw('DATE_FORMAT(start_date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '>=', Carbon::today()->toDateString())
            ->orWhereRaw('DATE_FORMAT(end_date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"')
                ->where('end_date', '>=', Carbon::today()->toDateString());
        })->orderBy('end_date', 'DESC')->paginate(6);

        $events->appends($request->only('keyword'));

        foreach ($events as $event) {
            $event->content = str_limit($event->content, 300);

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


    public function getPastCategory(Request $request, Category $category){
        $events = Event::whereCategoryId($category->id)
        ->where('end_date', '<', Carbon::today()->toDateString())
        ->when($request->keyword, function ($query) use ($request, $category){
            $query->whereRaw('DATE_FORMAT(end_date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereCategoryId($category->id)
                ->where('end_date', '<', Carbon::today()->toDateString())
            ->orWhereRaw('DATE_FORMAT(start_date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereCategoryId($category->id)
                ->where('end_date', '<', Carbon::today()->toDateString());
        })->orderBy('end_date', 'DESC')->paginate(6);

        $events->appends($request->only('keyword'));

        foreach ($events as $event) {
            $event->content = str_limit($event->content, 300);

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


    public function getUpcomingCategory(Request $request, Category $category){
        $events = Event::whereCategoryId($category->id)
        ->where('end_date', '>=', Carbon::today()->toDateString())
        ->when($request->keyword, function ($query) use ($request, $category){
            $query->whereRaw('DATE_FORMAT(start_date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereCategoryId($category->id)
                ->where('end_date', '>=', Carbon::today()->toDateString())
            ->orWhereRaw('DATE_FORMAT(end_date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereCategoryId($category->id)
                ->where('end_date', '>=', Carbon::today()->toDateString());
        })->orderBy('end_date', 'DESC')->paginate(6);

        $events->appends($request->only('keyword'));

        foreach ($events as $event) {
            $event->content = str_limit($event->content, 300);

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

        $tempData = new \stdClass();
        $tempData->type = 'event';
        $tempData->subject = 'Event registration';
        $tempData->event_name = $event->title;
        $tempData->name = $request->name;
        $tempData->phone = $request->phone;
        $tempData->email = $request->email;
        $tempData->gender = (int) $request->gender === 1 ? 'Male' : 'Female';
        $tempData->address = $request->address;
        $tempData->message = $request->message;

        Mail::to('respatibayu48@gmail.com')->send(new SendMail($tempData));

        return back();


    	// $applicantList = new ApplicantList;

        // $applicantList->event_id = $event->id;
        // $applicantList->name = $request->name;
        // $applicantList->email = $request->email;
        // $applicantList->phone = $request->phone;
        // $applicantList->is_approve = false;

        // $applicantList->save();

        // return back();
    }
}
