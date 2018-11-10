<?php

namespace App\Http\Controllers\Admin\Event;

use App\EventImage;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

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

    	return $imageList;
    }

    public function store(Request $request){

    	$path = public_path('img/event/');

        if(!is_dir($path)){
            file::makedirectory($path);
        }

        $imageName = time().'image.jpg';
        $image = $this->setImage($request->image);
        file_put_contents($path.$imageName,$image);


    	$eventImage =  new EventImage;

    	$eventImage->event_id = $request->eventId;
    	$eventImage->title = $request->title;
        $eventImage->description = $request->description;
    	$eventImage->is_poster = false;
    	$eventImage->image_path = url('img/event/'.$imageName);
    	$eventImage->save();

    	return $eventImage;
    }

    
    public function update(Request $request, EventImage $eventImage){

        //if admin change image
        if($request->image !== $eventImage->image_path){

            // remove the old image
            $path = public_path('img/event/');
            $this->removeImageOnServer($path,$eventImage->image_path);

            // put new image
            $imageName = time().'image.jpg';
            $image = $this->setImage($request->image);
            file_put_contents($path.$imageName,$image);

            $eventImage->image_path = url('img/event/'.$imageName);
        }

        $eventImage->title = $request->title;
        $eventImage->description = $request->description;
        $eventImage->is_poster = $request->is_poster;

        $eventImage->update();

        return $eventImage;
    }

    public function destroy(EventImage $eventImage){

        $path = public_path('img/event/');
        $this->removeImageOnServer($path,$eventImage->image_path);

        $eventImage->delete();
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
