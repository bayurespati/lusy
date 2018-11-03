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
        $gallery->is_showcase = 0;
        $gallery->image_path = url('img/gallery/'.$imageName);

        $gallery->save();

        return [$gallery->id,$gallery->image_path];
    }

    public function update(Request $request, Gallery $gallery){

        //if admin change image
        if($request->image !== $gallery->image_path){

            // remove the old image
            $path = public_path('img/gallery/');
            $this->removeImageOnServer($path,$gallery->image_path);

            // put new image
            $imageName = time().'image.jpg';
            $image = $this->setImage($request->image);
            file_put_contents($path.$imageName,$image);

            $gallery->image_path = url('img/gallery/'.$imageName);
        }

        $gallery->title = $request->title;
        $gallery->location = $request->location;
        $gallery->date = $request->date;
        $gallery->creator = $request->creator;
        $gallery->sub_category_id = $request->sub_category_id;

        $gallery->update();

        return $gallery->image_path;
    }

    public function destroy(Gallery $gallery){

        $path = public_path('img/gallery/');
        $this->removeImageOnServer($path,$gallery->image_path);

        $gallery->delete();
    }


    public function setImage($image){
        list(,$image) = explode(';', $image);
        list(,$image) = explode(',',$image);

        return base64_decode($image);
    }

    private function removeImageOnServer($path, $url) {
        $imageName = explode('/', $url);
        $imageName = $imageName[count($imageName)-1];

        if(file_exists($path.$imageName)) {
            unlink($path . $imageName);
        }
    }
}
