<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Category;
use App\ShopItem;
use App\ShopImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function index()
    {
        return view('admin.shop.list');
    }

    public function loadList()
    {
        $categories = Category::where('type','3')->with('subcategories')->get();
        $shopitem = ShopItem::all();

        $subCategories = [];

        foreach($categories as $keys => $category){
            foreach($category->subcategories as $key => $subcategory){
                array_push($subCategories, $subcategory);
            }
        }

    	return [$shopitem,$categories,$subCategories];
    }

    public function patch(Request $request, ShopItem $item){


        $item->title = $request->title;
        $item->sub_title = $request->sub_title;
        $item->stock = $request->stock;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->store_link = $request->store_link;
        $item->is_displayed = $request->is_displayed;
        $item->category_id = $request->category_id;
        $item->sub_category_id = $request->sub_category_id;

        $item->update();

        return $item;
    }

    public function store(Request $request){

        $shop = new ShopItem;

        $shop->title = $request->title;
        $shop->sub_title = $request->sub_title;
        $shop->stock = $request->stock;
        $shop->description = $request->description;
        $shop->price = $request->price;
        $shop->store_link = $request->store_link;
        $shop->is_displayed = $request->is_displayed;
        $shop->category_id = $request->category_id;
        $shop->sub_category_id = $request->sub_category_id;
        $shop->is_showcase = false;

        $shop->save();

        return $shop->id;
    }

    public function delete(Shopitem $item){
        $item->delete();
    }
}
