<?php

namespace App\Http\Controllers\Shop;

use App\Sosmed;
use App\Category;
use App\ShopItem;
use App\ImageConfig;
use App\SubCategory;
use App\ShopInquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index(){

    	$sosmed = Sosmed::all();
        $categories = Category::with('subcategories')->whereType(3)->get();

        $items = ShopItem::whereIsDisplayed(true)->paginate(8);

        $isItemsExist = count(ShopItem::all()) > 0 
        ? true 
        : false;

        $shopBanner = ImageConfig::find(5)->image_path === null 
        ? '/img/page-banner-bg.jpg'
        : ImageConfig::find(5)->image_path;

        foreach ($items as $item) {
            $item->poster = $item->poster()->get()->isEmpty()
            ? '/img/shop-item.gif'
            : $item->poster()->get()[0]->image_path;

            $item->price = number_format($item->price, 2, ",", ".");
        }

		return view('shop.index', compact('sosmed', 'categories', 'items', 'shopBanner', 'isItemsExist'));
    }


    public function getItems(ShopItem $shopItem){

    	$sosmed = Sosmed::all();

        $shopBanner = ImageConfig::find(5)->image_path === null 
        ? '/img/page-banner-bg.jpg'
        : ImageConfig::find(5)->image_path;

        $shopItem->poster = $shopItem->poster()->get()->isEmpty()
        ? '/img/welcome-1.jpg'
        : $shopItem->poster()->get()[0]->image_path;

        $shopItem->images = $shopItem->images()->whereIsPoster(false)->paginate(4);

        $shopItem->price = number_format($shopItem->price, 2, ",", ".");

		return view('shop.item', compact('sosmed', 'shopItem', 'shopBanner'));
    }


    public function getImageItems(ShopItem $shopItem){

    	return $shopItem->images()->whereIsPoster(false)->paginate(4);
    }


    public function getAll(Request $request){
    	$items = ShopItem::whereIsDisplayed(true)
        ->when($request->keyword, function ($query) use ($request) {
            $query->whereRaw('LOWER(title) LIKE "%' . strtolower($request->keyword) .'%"')
                ->whereIsDisplayed(true)
            ->orWhereRaw('LOWER(sub_title) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereIsDisplayed(true)
            ->orWhereRaw('LOWER(description) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereIsDisplayed(true);
        })->paginate(8);

        foreach ($items as $item) {
            $item->poster = $item->poster()->get()->isEmpty()
            ? '/img/shop-item.gif'
            : $item->poster()->get()[0]->image_path;

            $item->price = number_format($item->price, 2, ",", ".");

        }

        return $items;
    }


    public function getCategory(Request $request, Category $category){

    	$items = ShopItem::whereIsDisplayed(true)
        ->whereCategoryId($category->id)
        ->when($request->keyword, function ($query) use ($request, $category) {
            $query->whereRaw('LOWER(title) LIKE "%' . strtolower($request->keyword) .'%"')
                ->whereIsDisplayed(true)
                ->whereCategoryId($category->id)
            ->orWhereRaw('LOWER(sub_title) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereIsDisplayed(true)
                ->whereCategoryId($category->id)
            ->orWhereRaw('LOWER(description) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereIsDisplayed(true)
                ->whereCategoryId($category->id);
        })->paginate(8);

        foreach ($items as $item) {
            $item->poster = $item->poster()->get()->isEmpty()
            ? '/img/shop-item.gif'
            : $item->poster()->get()[0]->image_path;

            $item->price = number_format($item->price, 2, ",", ".");
        }

        return $items;
    }


    public function getSubcategory(Request $request, SubCategory $subcategory){

    	$items = ShopItem::whereIsDisplayed(true)
        ->whereSubCategoryId($subcategory->id)
        ->when($request->keyword, function ($query) use ($request, $subcategory) {
            $query->whereRaw('LOWER(title) LIKE "%' . strtolower($request->keyword) .'%"')
                ->whereIsDisplayed(true)
                ->whereSubCategoryId($subcategory->id)
            ->orWhereRaw('LOWER(sub_title) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereIsDisplayed(true)
                ->whereSubCategoryId($subcategory->id)
            ->orWhereRaw('LOWER(description) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereIsDisplayed(true)
                ->whereSubCategoryId($subcategory->id);
        })->paginate(8);

        foreach ($items as $item) {
            $item->poster = $item->poster()->get()->isEmpty()
            ? '/img/shop-item.gif'
            : $item->poster()->get()[0]->image_path;

            $item->price = number_format($item->price, 2, ",", ".");
        }

        return $items;
    }


    public function overseasInquiry(Request $request, ShopItem $shopItem){

    	$shopInquiry = new ShopInquiry;

        $shopInquiry->shop_item_id = $shopItem->id;
        $shopInquiry->buyer_name = $request->buyer_name;
        $shopInquiry->gender = $request->gender;
        $shopInquiry->email = $request->email;
        $shopInquiry->address = $request->address;
        $shopInquiry->city = $request->city;
        $shopInquiry->state_province = $request->state_province;
        $shopInquiry->postal_code = $request->postal_code;
        $shopInquiry->notes = $request->notes;
        $shopInquiry->quantity = $request->quantity;
        $shopInquiry->is_confirmed = 0;

        $shopInquiry->save();

        return back();
    }
}

