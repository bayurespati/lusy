<?php

namespace App\Http\Controllers\Admin\Bookkeeping;

use App\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    public function index(){
    	return view('admin.bookkeeping.region');
    }

    public function loadRegion(){
    	return Region::all();
    }

    public function addRegion(Request $request){
        $region = new Region;

        $region->name = $request->name;
        $region->city = $request->city;
        $region->address = $request->address;

        $region->save();

        return $region->id;
    }

    public function editRegion(Request $request, Region $region){

        $region->name = $request->name;
        $region->city = $request->city;
        $region->address = $request->address;

        $region->update();
    }

    public function deleteRegion(Region $region){
    	$region->delete();
    }
}
