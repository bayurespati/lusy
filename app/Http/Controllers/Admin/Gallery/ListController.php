<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Category;
use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function index()
    {
        return view('admin.gallery.list');
    }

    public function loadList()
    {
        $data = Category::where('type','1')->with('subcategories')->get();
        $gallery = Gallery::all();

        $categoreis = [];

        foreach($data as $category){
            if(count($category->subcategories) > null){
                array_push($categoreis,$category);
            }
        }

        return [$gallery,$categoreis];
    }

    public function store(Request $request){

        $path = public_path('img/gallery/');

        if(!is_dir($path)){
            file::makedirectory($path);
        }

        $imageName = time().'image.jpg';
        $image = $this->setImage($request->image);
        file_put_contents($path.$imageName,$image);

        $gallery = new Gallery;

        $gallery->sub_category_id = $request->sub_category_id;
        $gallery->title = $request->title;
        $gallery->date = $request->date;
        $gallery->location = $request->location;
        $gallery->creator = $request->creator;
        $gallery->image_path = url('img/gallery/'.$imageName);

        $gallery->save();

        return [$gallery->id,$gallery->image_path];
    }

    public function setImage($image){
        list(,$image) = explode(';', $image);
        list(,$image) = explode(',',$image);

        return base64_decode($image);
    }

    public function update(Request $request, Gallery $gallery){

        $gallery->title = $request->title;
        $gallery->location = $request->location;
        $gallery->date = $request->date;
        $gallery->creator = $request->creator;
        $gallery->sub_category_id = $request->sub_category_id;

        $gallery->update();
    }

    public function destroy(Gallery $gallery){
        $gallery->delete();
    }
}
