<?php

namespace App\Http\Controllers\About;

use App\Sosmed;
use App\AboutContent;
use App\ImageConfig;
use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index(){
    	$sosmed = Sosmed::all();
        $about = AboutContent::where('is_class', '=', false)->get();
        $classes = AboutContent::where('is_class', '=', true)->get();
        $aboutBanner = ImageConfig::find(2)->image_path === null 
        ? '/img/page-banner-bg.jpg'
        : ImageConfig::find(2)->image_path;

        $showcasedImage = Gallery::whereIsShowcase(true)->get();

        if(
            count($showcasedImage) > 0 && 
            count($showcasedImage) >= 4 && count($showcasedImage) < 8){
            $showedImage = Gallery::whereIsShowcase(true)->paginate(4); 
        }
        else {
            $showedImage = $showcasedImage;
        }

		return view('about.index', compact('sosmed', 'about', 'classes', 'showedImage', 'aboutBanner'));
    }
}
