<?php

namespace App\Http\Controllers\Admin\shop;

use App\ShopImage;
use App\ShopItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

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

    	return $imageList;
    }

    public function store(Request $request){

    	$path = public_path('img/shop/');

        if(!is_dir($path)){
            file::makedirectory($path);
        }

        $imageName = time().'image.jpg';
        $image = $this->setImage($request->image);
        file_put_contents($path.$imageName,$image);


    	$shopImage =  new ShopImage;

    	$shopImage->shop_item_id = $request->shopId;
    	$shopImage->title = $request->title;
    	$shopImage->is_poster = false;
    	$shopImage->image_path = url('img/shop/'.$imageName);
    	$shopImage->save();

    	return $shopImage;
    }

    
    public function update(Request $request, ShopImage $shopImage){

        //if admin change image
        if($request->image !== $shopImage->image_path){

            // remove the old image
            $path = public_path('img/shop/');
            $this->removeImageOnServer($path,$shopImage->image_path);

            // put new image
            $imageName = time().'image.jpg';
            $image = $this->setImage($request->image);
            file_put_contents($path.$imageName,$image);

            $shopImage->image_path = url('img/shop/'.$imageName);
        }

        $shopImage->title = $request->title;
        $shopImage->is_poster = $request->is_poster;

        $shopImage->update();

        return $shopImage;
    }

    public function destroy(ShopImage $shopImage){

        $path = public_path('img/shop/');
        $this->removeImageOnServer($path,$shopImage->image_path);

        $shopImage->delete();
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
