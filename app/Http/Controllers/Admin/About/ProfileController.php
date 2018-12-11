<?php

namespace App\Http\Controllers\Admin\About;

use App\AboutContent;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

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

        //if admin change image
        if($request->image !== $profile->image_path){

            //Remove current image on server
            $this->removeImageOnServer($path,$profile->image_path);

            //Set Image Before put on server
            $imageName = $this->setImage($request->image);

            $profile->image_path = url('img/profile/'.$imageName);
        }


        //Change detail data on database
        $profile->content = $request->content;
        $profile->title = $request->title;
        $profile->update();
        

        //return url to front end
        return $profile->image_path;
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
        
        $imageName = time().'profile.'.$this->getExtension($image);
        $image_resize = Image::make($image);
        $image_resize->resize($widthFix, $heightFix);
        $image_resize->save(public_path('img/profile/' .$imageName));

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

        if(file_exists($path.$imageName) && strpos($imageName, 'profile')) {
            unlink($path . $imageName);
        }
    }

}
