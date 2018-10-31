<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Category;
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
        $data = Category::where('type','1')->with('subCategories')->get();
        $categories = Category::where('type','1')->get();


        $subCategories = [];

        foreach($data as $category){
            foreach($category->subCategories as $subCateory){
                array_push($subCategories, $subCateory);
            }
        }

        return [$subCategories,$categories];
    }

    public function store(Request $request){

        $subcategory = new Subcategory;

        $subcategory->title = $request->title;
        $subcategory->category_id = $request->category_id;

        $subcategory->save();

        return $subcategory->id;
    }

    public function update(Request $request, Subcategory $subcategory){

        $subcategory->title = $request->title;
        $subcategory->category_id = $request->category_id;

        $subcategory->update();
    }

    public function destroy(Subcategory $subcategory){

        $subcategory->delete();
        
    }
}
