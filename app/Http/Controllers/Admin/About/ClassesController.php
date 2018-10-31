<?php

namespace App\Http\Controllers\Admin\About;

use App\AboutContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassesController extends Controller
{
    public function index()
    {
        return view('admin.about.classes');
    }

    public function loadClasses()
    {
    	return AboutContent::all();
    }

    public function patch(Request $request,AboutContent $class){

    }
}
