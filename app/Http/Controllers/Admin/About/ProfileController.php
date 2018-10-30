<?php

namespace App\Http\Controllers\Admin\About;

use App\AboutContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.about.profile');
    }

    public function loadProfile()
    {
    	return AboutContent::all();
    }

    public function patch(Request $request,AboutContent $profile){

    }
}
