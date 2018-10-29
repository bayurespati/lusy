<?php

namespace App\Http\Controllers\Admin;

use App\Sosmed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function loadSosmed()
    {
    	return Sosmed::all();
    }

    public function editSosmed(Request $request,Sosmed $sosmed){

        $sosmed->link = $request->link;
        $sosmed->is_active = $request->is_active;
        $sosmed->update();
    }
}