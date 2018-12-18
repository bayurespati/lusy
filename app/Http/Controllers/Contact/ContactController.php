<?php

namespace App\Http\Controllers\Contact;

use App\Sosmed;
use App\ImageConfig;
use App\ContactMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(){
    	$sosmed = Sosmed::all();

		return view('contact.index', compact('sosmed'));
    }

    public function message(Request $request){
    	$contact_message = new ContactMessage;

        $contact_message->name = $request->contact_fname .' '. $request->contact_lname;
        $contact_message->phone = $request->contact_phone;
        $contact_message->email = $request->contact_email;
        $contact_message->message = $request->contact_message;
        $contact_message->is_replay = false;

        $contact_message->save();

        return back();
    }
}
