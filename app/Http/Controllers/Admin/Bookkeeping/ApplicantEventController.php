<?php

namespace App\Http\Controllers\Admin\Bookkeeping;

use App\ApplicantList;
use App\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class ApplicantEventController extends Controller
{
    public function index(){

    	return view('admin.bookkeeping.applicant_event');

    }

    public function loadApplicantEvent(){

    	$upcomingEvents = Event::with('applicants')->whereDate('end_date', '>=', Carbon::today()->toDateString())->get();

    	return $upcomingEvents;
    }

    public function list($param){

        $event = Event::find($param);

        return view('admin.bookkeeping.applicant_list',compact('event'));

    }

    public function loadApplicantList(Event $event){

        $applicant_list = ApplicantList::where('event_id', $event->id)->get();

        return $applicant_list;
    }

    public function update(Request $request, ApplicantList $applicantList){

        $applicantList->is_approve = $request->is_approve;
        $applicantList->update();

        return $applicantList;
    }

    public function destroy(ApplicantList $applicantList){

        $applicantList->delete();
        
    }
}
