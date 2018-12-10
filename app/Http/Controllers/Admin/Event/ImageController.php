<?php

namespace App\Http\Controllers\Admin\Event;

use App\EventImage;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class ImageController extends Controller
{
    public function index($param)
    {
        $event = Event::find($param);
        return view('admin.event.image',compact('event'));
    }

    public function loadImageList($param)
    {	

    	$imageList = EventImage::where('event_id',$param)->get();

        foreach ($imageList as $photo) {
            $photo->imageType = $photo->type;
            $photo->description = $photo->description == null 
            ? '' 
            : $photo->description;
        }

    	return $imageList;
    }

    public function store(Request $request){

    	$path = public_path('img/event/');

        if(!is_dir($path)){
            file::makedirectory($path);
        }

        $imageName = $this->setImage($request->image);

    	$eventImage =  new EventImage;
    	$eventImage->event_id = $request->eventId;
    	$eventImage->title = $request->title;
        $eventImage->description = $request->description;
    	$eventImage->is_poster = false;
    	$eventImage->image_path = url('img/event/'.$imageName);
        $eventImage->type = $request->imageType;
    	$eventImage->save();

    	return $eventImage;
    }

    
    public function update(Request $request, EventImage $eventImage){

        //if admin change image
        if($request->image !== $eventImage->image_path){

            // remove the old image
            $path = public_path('img/event/');
            $this->removeImageOnServer($path,$eventImage->image_path);

            $imageName = $this->setImage($request->image);
            $eventImage->image_path = url('img/event/'.$imageName);
        }

        $eventImage->title = $request->title;
        $eventImage->description = $request->description;
        $eventImage->is_poster = $request->is_poster;
        $eventImage->type = $request->imageType;

        $eventImage->update();

        return $eventImage;
    }

    public function destroy(EventImage $eventImage){

        $path = public_path('img/event/');
        $this->removeImageOnServer($path,$eventImage->image_path);

        $eventImage->delete();
    }

    public function setImage($image){
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

        $image = $image;
        $imageName = time().'image.jpg';

        $image_resize = Image::make($image);              
        $image_resize->resize($widthFix, $heightFix);
        $image_resize->save(public_path('img/event/' .$imageName));

        return $imageName;
    }

    private function removeImageOnServer($path, $url) {
        $imageName = explode('/', $url);
        $imageName = $imageName[count($imageName)-1];

        if(file_exists($path.$imageName)) {
            unlink($path . $imageName);
        }
    }
}
