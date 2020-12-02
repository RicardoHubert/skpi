<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ormawa;
use App\Kegiatan;

class hmjController extends Controller
{
    //
    public function index($id){
    $ormawa = Ormawa::findorFail($id);
   
    $data_kegiatan = \App\Kegiatan::all();
    	return view('frontend_ormawa.hmj.index',['ormawa' => $ormawa, 'data_kegiatan' => $data_kegiatan]);
    }
}
