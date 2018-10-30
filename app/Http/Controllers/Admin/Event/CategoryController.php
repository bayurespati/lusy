<?php

namespace App\Http\Controllers\Admin\Event;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.event.categories');
    }

    public function loadCategory()
    {
    	return Category::all();
    }

    public function patch(Request $request, Category $category){

    }
}
