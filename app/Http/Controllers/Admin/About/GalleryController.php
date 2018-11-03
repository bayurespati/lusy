<?php

namespace App\Http\Controllers\Admin\About;

use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function index()
    {
        return view('admin.about.gallery_showcase');
    }

    public function loadGallery()
    {

    	$galleries = Gallery::all();

        $gallery_show = [];
        $gallery_hide = [];

        foreach($galleries as $gallery){
            if($gallery->is_showcase){
                array_push($gallery_show,$gallery);
            }else{
                array_push($gallery_hide,$gallery);
            }
        }

        return [$gallery_hide,$gallery_show];
    }

    public function update(Request $request,Gallery $gallery){

        $gallery->is_showcase = $request->is_showcase;
        $gallery->update();
    }
}
