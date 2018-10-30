<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubcategoryController extends Controller
{
    public function index()
    {
        return view('admin.gallery.subcategories');
    }

    public function loadSubcategory()
    {
    	return Subcategory::all();
    }

    public function patch(Request $request, Subcategory $subcategory){

    }
}
