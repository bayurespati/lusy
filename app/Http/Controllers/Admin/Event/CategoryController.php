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
        return Category::where('type','2')->get();
    }

    public function store(Request $request)
    {

        $category = new Category();

        $category->title = $request->title;
        $category->type = 2;

        $category->save();

        return $category->id;
    }

    public function update(Request $request, Category $category){
        $category->title = $request->title;
        $category->update();
    }

    public function destroy(Category $category)
    {
        $category->delete();
    }
}
