<?php

namespace App\Http\Controllers\Gallery;

use App\Sosmed;
use App\Category;
use App\ImageConfig;
use App\SubCategory;
use App\Gallery;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function index(){
    	$sosmed = Sosmed::all();
        $categories = Category::with('subcategories')->whereType(1)->get();
        $galleryBanner = ImageConfig::find(3)->image_path === null 
        ? '/img/page-banner-bg.jpg'
        : ImageConfig::find(3)->image_path;

        $gallery = Gallery::paginate(8);

        foreach ($gallery as $photo) {
            $photo->date = Carbon::parse($photo->date)->format('d-m-Y');
        }

        $sortedGallery = $gallery->sortByDesc('type');

		return view('gallery.index', compact('sosmed', 'categories', 'gallery', 'galleryBanner', 'sortedGallery'));
    }

    public function getAll(Request $request){
        $gallery = Gallery::when($request->keyword, function ($query) use ($request) {
            $query->whereRaw('LOWER(title) LIKE "%' . strtolower($request->keyword) .'%"')
            ->orWhereRaw('LOWER(creator) LIKE "%' . strtolower($request->keyword) . '%"')
            ->orWhereRaw('LOWER(location) LIKE "%' . strtolower($request->keyword) . '%"')
            ->orWhereRaw('DATE_FORMAT(date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"');
        })->paginate(8);

        $gallery->appends($request->only('keyword'));

        $gallerySorted[0] = $gallery;
        $gallerySorted[1] = [];

        foreach ($gallery->sortByDesc('type') as $photo) {
            $photo->date = Carbon::parse($photo->date)->format('d-m-Y');
            $photo->location = $photo->location == NULL 
            ? ""
            : $photo->location;
            $photo->creator = $photo->creator == NULL
            ? ""
            : $photo->creator;

            array_push($gallerySorted[1], $photo);
        }

        return $gallerySorted;
    }

    public function getCategory(Category $category){
    	return $category->subcategories()->get();
    }

    public function getSubcategory(Request $request, SubCategory $subcategory){
        $gallery = Gallery::whereSubCategoryId($subcategory->id)
        ->when($request->keyword, function ($query) use ($request, $subcategory) {
            $query->whereRaw('LOWER(title) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id)
            ->orWhereRaw('LOWER(creator) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id)
            ->orWhereRaw('LOWER(location) LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id)
            ->orWhereRaw('DATE_FORMAT(date, "%d-%m-%Y") LIKE "%' . strtolower($request->keyword) . '%"')
                ->whereSubCategoryId($subcategory->id);
        })->paginate(8);

        $gallery->appends($request->only('keyword'));

        $gallerySorted[0] = $gallery;
        $gallerySorted[1] = [];

        foreach ($gallery->sortByDesc('type') as $photo) {
            $photo->date = Carbon::parse($photo->date)->format('d-m-Y');
            $photo->location = $photo->location == NULL 
            ? ""
            : $photo->location;
            $photo->creator = $photo->creator == NULL
            ? ""
            : $photo->creator;
            
            array_push($gallerySorted[1], $photo);
        }

        return $gallerySorted;
    }


}
