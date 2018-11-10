<?php

namespace App\Http\Controllers\Admin\Bookkeeping;

use App\Mail\SendMail;
use App\ContactMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index(){
    	return view('admin.bookeeping.message');
    }

    public function loadMessage(){

    	return ContactMessage::where('is_replay', 0)->get();
    }

    public function sendMail(Request $request, ContactMessage $contactMessage){

	    $tempData = new \stdClass();
	    $tempData->message = $request->message;
	    $tempData->subject = $request->subject;
	    $tempData->receiver_name = $contactMessage->name;
	    $tempData->sender_name = "Bayu Respati";

	    Mail::to($contactMessage->email)->send(new SendMail($tempData));

	    $contactMessage->is_replay = true;
	    $contactMessage->update();

	    return $contactMessage;
    }
}
