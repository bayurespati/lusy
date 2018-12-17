<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Category;
use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

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

        foreach ($gallery as $photo) {
            $photo->imageType = $photo->type;
        }

        return [$gallery,$categoreis];
    }

    public function store(Request $request){
        $path = public_path('img/gallery/');

        if(!is_dir($path)){
            file::makedirectory($path);
        }

        $imageName = $this->setImage($request->image);

        $gallery = new Gallery;

        $gallery->sub_category_id = $request->sub_category_id;
        $gallery->title = $request->title;
        $gallery->date = $request->date;
        $gallery->location = $request->location;
        $gallery->creator = $request->creator;
        $gallery->is_showcase = 0;
        $gallery->image_path = url('img/gallery/'.$imageName);
        $gallery->type = $request->imageType;

        $gallery->save();

        return [$gallery->id,$gallery->image_path];
    }

    public function update(Request $request, Gallery $gallery){

        //if admin change image
        if($request->image !== $gallery->image_path){

            // remove the old image
            $path = public_path('img/gallery/');
            $this->removeImageOnServer($path,$gallery->image_path);

            $imageName = $this->setImage($request->image);
            $gallery->image_path = url('img/gallery/'.$imageName);
        }

        $gallery->title = $request->title;
        $gallery->location = $request->location;
        $gallery->date = $request->date;
        $gallery->creator = $request->creator;
        $gallery->sub_category_id = $request->sub_category_id;
        $gallery->type = $request->imageType;

        $gallery->update();

        return $gallery->image_path;
    }

    public function destroy(Gallery $gallery){

        $path = public_path('img/gallery/');
        $this->removeImageOnServer($path,$gallery->image_path);

        $gallery->delete();
    }

    public function setImage($image){
        // SET WIDTH AND HEIGHT
        list($width, $height) = getimagesize($image);

        $widthFix = 0;
        $heightFix = 0;

        if($width > 1000 || $height > 1000){
            $MAXSIZE = $width > $height ? $width : $height;

            $result = $MAXSIZE - 1000;
            $percentage = ceil($result / $MAXSIZE * 100);

            $widthFix = $width - ($width * $percentage / 100);
            $heightFix = $height - ($height * $percentage / 100);

        }else{
            $widthFix = $width;
            $heightFix = $height;
        }
        
        $imageName = time().'image.'.$this->getExtension($image);
        $image_resize = Image::make($image);
        $image_resize->resize($widthFix, $heightFix);
        $image_resize->save(public_path('img/gallery/' .$imageName));

        return $imageName;
    }

    private function getExtension($image){
        list($extension,$image) = explode(';', $image);
        list(,$extension) = explode('/',$extension);

        return $extension;
    }

    private function removeImageOnServer($path, $url) {
        $imageName = explode('/', $url);
        $imageName = $imageName[count($imageName)-1];

        if(file_exists($path.$imageName)) {
            unlink($path . $imageName);
        }
    }
}
