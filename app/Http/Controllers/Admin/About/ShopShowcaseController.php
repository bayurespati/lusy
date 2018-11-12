<?php

namespace App\Http\Controllers\Admin\About;

use App\ShopItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopShowcaseController extends Controller
{
    public function index(){
    	return view('admin.about.shop_showcase');
    }


    public function loadShop()
    {
    	$shops = ShopItem::with('poster')->get();

    	$shop_show = [];
        $shop_hide = [];

        foreach($shops as $shop){
            if($shop->is_showcase){
                array_push($shop_show,$shop);
            }else{
                array_push($shop_hide,$shop);
            }
        }

        return [$shop_hide,$shop_show];
    }

    public function update(Request $request, ShopItem $shopItem){
    	$shopItem->is_showcase = $request->is_showcase;
    	$shopItem->update();
    }
}
