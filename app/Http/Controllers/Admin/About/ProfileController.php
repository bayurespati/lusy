<?php

namespace App\Http\Controllers\Admin\About;

use App\AboutContent;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.about.profile');
    }

    public function loadProfile()
    {
    	return AboutContent::where('is_class',0)->get()[0];
    }

    public function update(Request $request,AboutContent $profile)
    {   
        //Create path and directory(if not aviable)
        $path = public_path('img/profile/');
        if(!is_dir($path)){
            file::makedirectory($path);
        }

        //Set Image Before put on server
        $imageName = 'profile.jpg';
        $image = $this->setImage($request->image);

        //Remove current image on server
        $this->removeImageOnServer($path,$profile->image_path);

        //Change detail data on database
        $profile->image_path = url('img/profile/'.$imageName);
        $profile->content = $request->content;
        $profile->title = $request->title;
        $profile->update();

        //Put image content on sever
        file_put_contents($path.$imageName,$image);

        //return url to front end
        return $profile->image_path;
    }

    private function setImage($image){
        list(,$image) = explode(';', $image);
        list(,$image) = explode(',',$image);

        return base64_decode($image);
    }

    private function removeImageOnServer($path, $url) {
        $imageName = explode('/', $url);
        $imageName = $imageName[count($imageName)-1];

        if(file_exists($path.$imageName) && $imageName == 'profile.jpg') {
            unlink($path . $imageName);
        }
    }

}
