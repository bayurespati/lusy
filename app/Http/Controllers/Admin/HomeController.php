<?php

namespace App\Http\Controllers\Admin;

use App\Sosmed;
use App\ImageSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

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

    public function deleteImageSlider(ImageSlider $imageSlider){

        $this->removeImageOnServer($imageSlider->image_ori);
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


    public function addImageSlider(Request $request){

        $path = public_path('img/home/');

        if(!is_dir($path)){
            file::makedirectory($path);
        }

        $imageOriName = time().'image_ori.jpg';
        $imageOri = $this->setImage($request->image_ori);
        file_put_contents($path.$imageOriName,$imageOri);

        $imageShowName = time().'image_show.jpg';
        $imageShow = $this->setImage($request->image_show);
        file_put_contents($path.$imageShowName,$imageShow);


        $thumbnailName = time().'thumbail.jpg';
        $thumbail = $this->setImage($request->thumbnail);
        file_put_contents($path.$thumbnailName,$thumbail);

        $imageSlider = new ImageSlider();

        $imageSlider->image_points = $request->image_points;
        $imageSlider->image_show = url('img/home/'.$imageShowName);
        $imageSlider->image_ori = url('img/home/'.$imageOriName);
        $imageSlider->thumbnail = url('img/home/'.$thumbnailName);
        $imageSlider->save();

        return $imageSlider->id;
    }

    public function setImage($image){
        list(,$image) = explode(';', $image);
        list(,$image) = explode(',',$image);

        return base64_decode($image);
    }
}