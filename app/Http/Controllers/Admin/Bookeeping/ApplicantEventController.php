<?php

namespace App\Http\Controllers\Admin\Bookeeping;


use App\Event;
use App\ApplicantList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicantEventController extends Controller
{
    public function index(){
    	return view('admin.bookeeping.applicant_event');
    }

    public function loadApplicantEvent(){

    	$upcomingEvents = Event::whereDate('end_date', '>=', Carbon::today()->toDateString())->get();

    	// $applicant_event = ApplicantList::with('event')->where('is_approve', 0)->get();

    	// dd(
    		// $upcomingEvents
    	// );

    	return $upcomingEvents;
    }
}
