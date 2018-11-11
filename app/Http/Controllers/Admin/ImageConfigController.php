<?php

namespace App\Http\Controllers\Admin;

use App\ImageConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class ImageConfigController extends Controller
{
    public function index(){
    	return view('admin.home.image_config');
    }

    public function loadImageConfig(){

    	$imageConfig = ImageConfig::all();

    	return $imageConfig;
    }

    public function update (Request $request, ImageConfig $imageConfig){

    	$path = public_path('img/config/');
    	if(!is_dir($path)){
            file::makedirectory($path);
        }

    	if( $imageConfig->image_path !== NULL ){
    		$this->removeImageOnServer($imageConfig->image_path);
    	}

    	$imageName = time().$imageConfig->page_name . '.jpg';
        $image = $this->setImage($request->image);
        file_put_contents($path.$imageName,$image);

        $imageConfig->image_path = url('img/config/'.$imageName);
        $imageConfig->update();

        return $imageConfig;
    }

    public function setImage($image){
        list(,$image) = explode(';', $image);
        list(,$image) = explode(',',$image);

        return base64_decode($image);
    }

    private function removeImageOnServer($url) {
        $path = public_path('img/config/');

        $imageName = explode('/', $url);
        $imageName = $imageName[count($imageName)-1];

        if(file_exists($path.$imageName)) {
            unlink($path.$imageName);
        }
    }
}
