<?php

namespace App\Http\Controllers\Admin\Bookkeeping;

use App\ShopInquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OverseasController extends Controller
{
    public function index(){
    	return view('admin.bookkeeping.inquiry');
    }

    public function potential(){
    	return view('admin.bookkeeping.potential');
    }

    public function loadOverseas(){
    	return ShopInquiry::with('shop')->where('is_confirmed', 1)->get();
    }

    public function loadPotentialOverseas(){
    	return ShopInquiry::with('shop')->where('is_confirmed', 0)->get();
    }

    public function update(Request $request, ShopInquiry $shopInquiry){

        $shopInquiry->is_confirmed = true;
        $shopInquiry->update();

    }

    public function destroy(ShopInquiry $shopInquiry){
        
        $shopInquiry->delete();
        
    }
}
