<?php

namespace App\Http\Controllers;

use App\Kegiatan;
use App\Models\BackgroundImage;
use App\kompetisiinternal;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
    	# code...

    	return view('dashboard.index');
    }
    public function visimisi(){
    	return view('frontend.visimisi');
    }
    public function home_frontend(){
        $backgrounds = BackgroundImage::all();
        $kegiatans = Kegiatan::latest()->get()->take(3);
        $prestasis = kompetisiinternal::latest()->get()->take(3);

    	return view('frontend.home', compact('backgrounds', 'kegiatans', 'prestasis'));
    }
}
