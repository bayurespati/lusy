<?php

namespace App\Http\Controllers\Admin\About;

use App\AboutContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

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
        $imageName = time().'class.jpg';
        $image = $this->setImage($request->image);

        $class = new AboutContent;
        $class->title = $request->title;
        $class->content = $request->content;
        $class->is_class = 1;
        $class->image_path =  url('img/class/'.$imageName);
        $class->save();


        //Put image content on sever
        file_put_contents($path.$imageName,$image);

        return $class;
    }

    public function update(Request $request,AboutContent $class){

        //Create path and directory(if not aviable)
        $path = public_path('img/class/');
        if(!is_dir($path)){
            file::makedirectory($path);
        }

        //Set Image Before put on server
        $imageName = time().'class.jpg';
        $image = $this->setImage($request->image);

        //Remove current image on server
        $this->removeImageOnServer($path,$class->image_path);

        //Change detail data on database
        $class->image_path = url('img/class/'.$imageName);
        $class->content = $request->content;
        $class->title = $request->title;
        $class->update();

        //Put image content on sever
        file_put_contents($path.$imageName,$image);

        //return url to front end
        return $class;

    }

    public function destroy(AboutContent $class){

        $path = public_path('img/class/');
        $this->removeImageOnServer($path,$class->image_path);
        
        $class->delete();
    }

     private function setImage($image){
        list(,$image) = explode(';', $image);
        list(,$image) = explode(',',$image);

        return base64_decode($image);
    }

    private function removeImageOnServer($path, $url) {
        $imageName = explode('/', $url);
        $imageName = $imageName[count($imageName)-1];

        if(file_exists($path.$imageName) && strpos($imageName, 'class.jpg')) {
            unlink($path . $imageName);
        }
    }
}
