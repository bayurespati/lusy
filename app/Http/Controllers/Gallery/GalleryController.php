<?php

namespace App\Http\Controllers\Gallery;

use App\Sosmed;
use App\Category;
use App\ImageConfig;
use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function index(){
    	$sosmed = Sosmed::all();
        $categories = Category::with('subcategories')->whereType(1)->get();
        $gallery = Gallery::paginate(8);
        $galleryBanner = ImageConfig::find(3)->image_path === null 
        ? '/img/page-banner-bg.jpg'
        : ImageConfig::find(3)->image_path;

		return view('gallery.index', compact('sosmed', 'categories', 'gallery', 'galleryBanner'));
    }

    public function getAll(){
	    $gallery = Gallery::paginate(8);

        return $gallery;    	
    }

    public function getCategory(Category $category){
    	return $category->subcategories()->get();
    }

    public function getSubcategory(){
    	$gallery = Gallery::whereSubCategoryId($subcategory->id)->paginate(8);

        return $gallery;
    }

}
