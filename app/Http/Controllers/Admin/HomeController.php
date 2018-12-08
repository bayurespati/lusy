<?php

namespace App\Http\Controllers\Admin;

use App\Sosmed;
use App\ImageSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;


class HomeController extends Controller
{
    public function sosmed()
    {
        return view('admin.home.sosmed');
    }

    public function imageSlider()
    {
        return view('admin.home.slider');
    }


    public function loadSosmed()
    {
    	return Sosmed::all();
    }

    public function editSosmed(Request $request,Sosmed $sosmed){

        $sosmed->link = $request->link;
        $sosmed->is_active = $request->is_active;
        $sosmed->update();
    }

    public function loadImageSlider(){
        return ImageSlider::all();
    }

    public function addImageSlider(Request $request){

        $path = public_path('img/home/');

        if(!is_dir($path)){
            file::makedirectory($path);
        }

        list($width, $height) = getimagesize($request->image);
        $imageShowName = time().'image_show.jpg';
        $image_resize = Image::make($request->image);
        $image_resize->resize($width, $height);
        $image_resize->save(public_path('img/home/' .$imageShowName));

        $thumbnailName = time().'thumbail.jpg';
        $image_resize = Image::make($request->image);
        $image_resize->resize(100, 100);
        $image_resize->save(public_path('img/home/' .$thumbnailName));
        
        $imageSlider = new ImageSlider();
        $imageSlider->image_show = url('img/home/'.$imageShowName);
        $imageSlider->thumbnail = url('img/home/'.$thumbnailName);
        $imageSlider->save();

        return $imageSlider;
    }


    public function deleteImageSlider(ImageSlider $imageSlider){

        $this->removeImageOnServer($imageSlider->image_show);
        $this->removeImageOnServer($imageSlider->thumbnail);
        
        $imageSlider->delete();
    }

    private function removeImageOnServer($url) {
        $path = public_path('img/home/');

        $imageName = explode('/', $url);
        $imageName = $imageName[count($imageName)-1];

        if(file_exists($path.$imageName)) {
            unlink($path.$imageName);
        }
    }

    public function setImage($image){
        list(,$image) = explode(';', $image);
        list(,$image) = explode(',',$image);

        return base64_decode($image);
    }
}