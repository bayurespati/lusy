<?php

namespace App\Http\Controllers\Contact;

use App\Sosmed;
use App\ContactMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(){
    	$sosmed = Sosmed::all();

		return view('contact.index', compact('sosmed'));
    }

    public function message(Request $request){

        $tempData = new \stdClass();
        $tempData->type = 'message';
        $tempData->name = $request->contact_name;
        $tempData->phone = $request->contact_phone;
        $tempData->email = $request->contact_email;
        $tempData->subject = $request->contact_subject;
        $tempData->message = $request->contact_message;

        Mail::to('respatibayu48@gmail.com')->send(new SendMail($tempData));

        return back();

	//    $contact_message = new ContactMessage;
    //    $contact_message->name = $request->contact_fname .' '. $request->contact_lname;
    //    $contact_message->phone = $request->contact_phone;
    //    $contact_message->email = $request->contact_email;
    //    $contact_message->message = $request->contact_message;
    //    $contact_message->is_replay = false;
    //    $contact_message->save();
    //    return back();
    }
}
