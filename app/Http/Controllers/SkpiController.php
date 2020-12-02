<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

class SkpiController extends Controller
{
    //
    public function index(Request $request)
    {
        set_time_limit(0);
        if($request->has('cari')){
            $data_kalbiser = \App\kalbiser::where('Prodi','LIKE','%'.$request->cari. '%')->get();
                $data_skpi = \App\Skpi::all();
               $paginate = \App\Skpi::paginate(3);
               $users = \App\User::all();
        }else{
                # code...
            $data_skpi = \App\Skpi::all();
            $data_kalbiser = \App\kalbiser::all();
            $users = \App\User::all();

        }
        
	    return view('skpi.index',['data_skpi' => $data_skpi,'data_kalbiser' => $data_kalbiser, 'users' => $users]);
    }

    public function create(Request $request)
    {
        # code...
        // Insert ke table Skpi
        $carbon = Carbon::parse($request->tanggal_dokumen);
        $Skpi = \App\Skpi::create(array_merge($request->all(), ['nomor_urut' => 0, 'tanggal_dokumen' => $carbon->isoFormat('Y/MM/DD')]));
        
        if($request->hasfile('file_skpi')){
            $file = $request->file('file_skpi');
            $filename = $file->getClientOriginalName();
            $file->move('fileskpi/', $filename);

            $Skpi->file_skpi = 'fileskpi/' . $filename;
            $Skpi->save();
        }
        return redirect('/skpi')->with('sukses','Data berhasil diinput');
    }



    public function edit($id)
    {
        # code...

        $data_skpi= \App\Skpi::find($id);
            $data_kalbiser = \App\kalbiser::all();
         return view('skpi/edit',['data_skpi' => $data_skpi,'data_kalbiser' => $data_kalbiser]);
    }

    public function update(Request $request,$id)
    {
        # code...
        //dd($request->all());

        $data_skpi = \App\Skpi::find($id);
        // $data_ormawa = \App\Ormawa::find($id);
        $data_kalbiser = \App\kalbiser::all();
        // $data_kompetisi = \App\Kompetisiinternal::find($id);
        // $data_kegiatan = \App\Kegiatan::find($id);


        $request->validate([
            'user_id' => 'nullable',
            // 'kompetisi_id' => 'nullable',
            // 'kegiatan_id' => 'nullable',
            'jenis_dokumen' => 'nullable',
            'tanggal_dokumen' => 'nullable',
            'judul_sertifikat' => 'nullable',
            'penyelenggara' => 'nullable',
            'tahun' => 'nullable',
            'ormawa_id' => 'nullable',
        ]);

            $data_skpi->user_id = $request->user_id;
            // $data_skpi->kompetisi_id = $request->kompetisi_id;
            // $data_skpi->kegiatan_id = $request->kegiatan_id;

            $data_skpi->jenis_dokumen = $request->jenis_dokumen;
            $data_skpi->ormawa_id = $request->ormawa_id;
            $data_skpi->judul_sertifikat = $request->judul_sertifikat;
            $data_skpi->penyelenggara = $request->penyelenggara;

        $data_skpi->save();

        return redirect('/skpi')->with('sukses','Data berhasil di updates');

    }



    public function delete(Request $request,$id)
    {
        # code..
        $Skpi = \App\Skpi::find($id);
        $Skpi->delete($Skpi);
        return redirect('/skpi')->with('sukses','Data berhasil di Hapus');
    }

    public function approveindex(Request $request)
    {
            # code...
        $data_skpi = \App\Skpi::all();
        $data_kalbiser = \App\kalbiser::all();
        $data_kompetisi = \App\kompetisiinternal::all();
        $data_ormawa = \App\Ormawa::all();
        $data_kegiatan = \App\Kegiatan::all();


        return view('approveskpi.index',['data_skpi' => $data_skpi,'data_kalbiser' => $data_kalbiser,'data_kompetisi' => $data_kompetisi,'data_kegiatan' => $data_kegiatan, 'data_ormawa' => $data_ormawa]);
    }

    public function approvestatus($id)
    {
        $skpi = \App\Skpi::find($id);
        $skpi->status = '1';
        $skpi->approvedby = auth()->user()->id;
        $skpi->save();

        noty()->flash('Yay!', 'Your data has been approved');
        return redirect()->back();
    }


    public function approvestatus2($id)
    {
        $skpi = \App\Skpi::find($id);
        $skpi->status = '0';
        $skpi->save();

        noty()->flash('Yay!', 'Your data has been disapproved');
        return redirect()->back();
    }


    public function approvestatusall()
    {
        $approveId = request('approveId');
        $skpi = \App\Skpi::whereIn('id', $approveId)->get();

        foreach ($skpi as $skpirow) {
    // Code Here
         $skpirow->status = '1';
         $skpirow->save();
        }
        
        noty()->flash('Yay!', 'Your data has been approved');
        return redirect()->back();
    }
    

}

