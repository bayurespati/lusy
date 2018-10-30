<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.gallery.categories');
    }

    public function loadCategory()
    {
    	return Category::all();
    }

    public function patch(Request $request, Category $category){

    }
}
