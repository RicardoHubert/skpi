<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class approvaleksternal extends Controller
{
    //
         public function index(Request $request)
    {
    	# code...
    	$data_approval_eksternal = \App\data_approval_eksternal::all();
           $data_kompetisiinternal = \App\kompetisiinternal::all();
           $data_kalbiser = \App\kalbiser::all();
    return view('approvaleksternal.index',['data_approval_eksternal' => $data_approval_eksternal,'data_kalbiser' => $data_kalbiser,'data_kompetisiinternal' => $data_kompetisiinternal]);
}
