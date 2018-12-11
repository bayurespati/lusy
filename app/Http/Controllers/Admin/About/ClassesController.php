<?php

namespace App\Http\Controllers\Admin\About;

use App\AboutContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class ClassesController extends Controller
{
    public function index()
    {
        return view('admin.about.classes');
    }

    public function loadClasses()
    {
    	return AboutContent::where('is_class',1)->get();
    }

    public function store(Request $request){

        //Create path and directory(if not aviable)
        $path = public_path('img/class/');
        if(!is_dir($path)){
            file::makedirectory($path);
        }

        //Set Image Before put on server
        $imageName = $this->setImage($request->image);

        $class = new AboutContent;
        $class->title = $request->title;
        $class->content = $request->content;
        $class->is_class = 1;
        $class->image_path =  url('img/class/'.$imageName);
        $class->save();

        return $class;
    }

    public function update(Request $request,AboutContent $class){

        //Create path and directory(if not aviable)
        $path = public_path('img/class/');
        if(!is_dir($path)){
            file::makedirectory($path);
        }

        //if admin change image
        if($request->image !== $class->image_path){

            //Remove current image on server
            $this->removeImageOnServer($path,$class->image_path);

            //Set Image Before put on server
            $imageName = $this->setImage($request->image);

            $class->image_path = url('img/class/'.$imageName);
        }

        //Change detail data on database        
        $class->content = $request->content;
        $class->title = $request->title;
        $class->update();

        //return url to front end
        return $class;

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
        
        $imageName = time().'class.'.$this->getExtension($image);
        $image_resize = Image::make($image);
        $image_resize->resize($widthFix, $heightFix);
        $image_resize->save(public_path('img/class/' .$imageName));

        return $imageName;
    }

    public function destroy(AboutContent $class){

        $path = public_path('img/class/');
        $this->removeImageOnServer($path,$class->image_path);
        
        $class->delete();
    }

    private function getExtension($image){
        list($extension,$image) = explode(';', $image);
        list(,$extension) = explode('/',$extension);

        return $extension;
    }

    private function removeImageOnServer($path, $url) {
        $imageName = explode('/', $url);
        $imageName = $imageName[count($imageName)-1];

        if(file_exists($path.$imageName) && strpos($imageName, 'class')) {
            unlink($path . $imageName);
        }
    }
}
