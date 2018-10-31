<?php

namespace App\Http\Controllers\Admin\Shop;

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
    	return ShopItem::all();
    }

    public function patch(Request $request, ShopItem $item){

    }
}
