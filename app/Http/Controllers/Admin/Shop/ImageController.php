<?php

namespace App\Http\Controllers\Admin\shop;

use App\ShopImage;
use App\ShopItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class ImageController extends Controller
{
    public function index($param)
    {
        $shopItem = ShopItem::find($param);
        return view('admin.shop.image',compact('shopItem'));
    }

    public function loadImageList($param)
    {	

    	$imageList = ShopImage::where('shop_item_id',$param)->get();

        foreach ($imageList as $photo) {
            $photo->imageType = $photo->type;
        }

    	return $imageList;
    }

    public function store(Request $request){

    	$path = public_path('img/shop/');

        if(!is_dir($path)){
            file::makedirectory($path);
        }

        $imageName = $this->setImage($request->image);

    	$shopImage =  new ShopImage;

    	$shopImage->shop_item_id = $request->shopId;
    	$shopImage->title = $request->title;
    	$shopImage->is_poster = false;
    	$shopImage->image_path = url('img/shop/'.$imageName);
        $shopImage->type = $request->imageType;
    	$shopImage->save();

    	return $shopImage;
    }

    
    public function update(Request $request, ShopImage $shopImage){

        //if admin change image
        if($request->image !== $shopImage->image_path){

            // Remove the old image
            $path = public_path('img/shop/');
            $this->removeImageOnServer($path,$shopImage->image_path);

            $imageName = $this->setImage($request->image);
            $shopImage->image_path = url('img/shop/'.$imageName);
        }

        $shopImage->title = $request->title;
        $shopImage->is_poster = $request->is_poster;
        $shopImage->type = $request->imageType;

        $shopImage->update();

        return $shopImage;
    }

    public function destroy(ShopImage $shopImage){

        $path = public_path('img/shop/');
        $this->removeImageOnServer($path,$shopImage->image_path);

        $shopImage->delete();
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
        $image_resize->save(public_path('img/shop/' .$imageName));

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
