<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function index()
    {
        return view('admin.gallery.list');
    }

    public function loadList()
    {
    	return Gallery::all();
    }

    public function patch(Request $request, Gallery $gallery){

    }
}
