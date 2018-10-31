<?php

namespace App\Http\Controllers\Admin\About;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function index()
    {
        return view('admin.about.gallery_showcase');
    }

    public function loadGallery()
    {
    	return AboutContent::all();
    }

    public function patch(Request $request,AboutContent $gallery){

    }
}
