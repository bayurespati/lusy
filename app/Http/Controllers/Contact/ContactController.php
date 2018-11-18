<?php

namespace App\Http\Controllers\Contact;

use App\sosmed;
use App\ImageConfig;
use App\ContactMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(){
    	$sosmed = Sosmed::all();

        $contactBanner = ImageConfig::find(6)->image_path === null 
        ? '/img/page-banner-bg.jpg'
        : ImageConfig::find(6)->image_path;

		return view('contact.index', compact('sosmed', 'contactBanner'));
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
