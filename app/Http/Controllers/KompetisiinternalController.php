<?php

namespace App\Http\Controllers;

use App\FileKompetisiInternal;
use App\Ormawa;
use App\User;
use App\kalbiser;
use App\kompetisiinternal;
use Illuminate\Http\Request;

class KompetisiinternalController extends Controller
{
    //
       public function index(Request $request)
    {
        $kalbisers = kalbiser::all();
        $kompetisiinternals = kompetisiinternal::all();
        $ormawas = Ormawa::all();
       
      

        // return $kompetisiinternal;
        
        return view('kompetisiinternal.index', compact('kalbisers','kompetisiinternals','ormawas'));
    }

      public function create(Request $request)
    {
         return view ('kompetisiinternal.index');
      
     }
        # code...


          public function store(Request $request){
         $kompetisiinternal = new kompetisiinternal();
       
             $request->validate([

            'poster' => 'mimes:jpeg,jpg,png,docx,doc,ppt,pptx,pdf,txt', 
            'ormawa_id' => 'nullable',
            'user_id' => 'nullable',
            'nama_kompetisi' => 'nullable',
            'jenis_kompetisi' => 'nullable',
            'url' => 'nullable',
            'sertifikat' => 'nullable',
            'skala' => 'nullable',
            'pencapaian' => 'nullable',
            'nama_kegiatan' => 'nullable',
            'tanggal_kegiatan' => 'nullable',
            'penyelenggara' => 'nullable',
            'status' => 'nullable', 

            'file_sertifikat' => 'mimes:jpeg,jpg,png,docx,doc,ppt,pptx,pdf,txt'


        ]);


        $tempat_upload = public_path('posterkompetisi/');
        $poster = $request->file('poster');
        $ext = $poster->getClientOriginalName();
        $filename =$ext;
        // print_r($ext);
        $poster->move($tempat_upload, $filename);
        $kompetisiinternal->poster = 'laravel/public/posterkompetisi/' . $filename;

        $tempat_upload2 = public_path('file_sertifikat/');
        $file_sertifikat = $request->file('file_sertifikat');
        $ext2 = $file_sertifikat->getClientOriginalName();
        $filename2 =$ext2;
        // print_r($ext2);
        $file_sertifikat->move($tempat_upload2, $filename2);
        $kompetisiinternal->file_sertifikat = 'laravel/public/file_sertifikat/' . $filename2;

        $kompetisiinternal->ormawa_id = $request->ormawa_id;
        $kompetisiinternal->user_id = $request->user_id;
        $kompetisiinternal->nama_kompetisi = $request->nama_kompetisi;
        $kompetisiinternal->jenis_kompetisi = $request->jenis_kompetisi;
        $kompetisiinternal->url = $request->url;
        $kompetisiinternal->sertifikat = $request->sertifikat;
        $kompetisiinternal->skala = $request->skala;
        $kompetisiinternal->pencapaian = $request->pencapaian;
        $kompetisiinternal->nama_kegiatan = $request->nama_kegiatan;
        $kompetisiinternal->tanggal_kegiatan = $request->tanggal_kegiatan;
        $kompetisiinternal->penyelenggara = $request->penyelenggara;
       
        $kompetisiinternal->status = $request->status;
       
        $kompetisiinternal->save();
          
        return redirect('k-internal')->with('sukses','Data berhasil diinput');
    }
         public function edit($id)
    {
        # code...
        $kompetisiinternal = \App\kompetisiinternal::find($id);
        return view('kompetisiinternal/edit',['kompetisiinternal' => $kompetisiinternal]);
    }
    public function update(Request $request,$id)
    {
        # code...
        //dd($request->all());
        $kompetisiinternal = \App\kompetisiinternal::find($id);
        $kompetisiinternal->update($request->all());

            if($request->hasfile('poster')){
            $file2 = $request->file('poster');
            $filename2 = $file2->getClientOriginalName();
            $file2->move('posterkompetisi/', $filename2);

            $kompetisiinternal->poster = 'posterkompetisi/' . $filename2;
            $kompetisiinternal->save();  

        }

        // if($request->hasfile('file_sertifikat')){
        //     $request->file('file_sertifikat')->move('file_sertifikat/',$request->file('file_sertifikat')->getClientOriginalName());
        //     $kompetisiinternal->file_sertifikat = $request->file('file_sertifikat')->getClientOriginalName();
        //     $kompetisiinternal->save();


        // }

        if($request->hasfile('file_sertifikat')){
            $file = $request->file('file_sertifikat');
            $filename = $file->getClientOriginalName();
            $file->move('file_sertifikat/', $filename);

            $kompetisiinternal->file_sertifikat = 'file_sertifikat/' . $filename;
            $kompetisiinternal->save();  

       
    }
     return redirect('/k-internal')->with('sukses','Data berhasil di updates');
 }
    public function delete(Request $request,$id)
    {
        # code..
        $kompetisiinternal = \App\kompetisiinternal::find($id);
        $kompetisiinternal->delete($kompetisiinternal);
        return redirect('/k-internal')->with('sukses','Data berhasil di Hapus');
    }   

    public function approveindex()
        {
        $kalbisers = kalbiser::all();
        $kompetisiinternals = kompetisiinternal::all();
        $ormawas = Ormawa::all();

        
        return view('approvekompetisi.index', compact('kalbisers','kompetisiinternals','ormawas'));
    }   

    public function approvestatus($id)
    {
        $kompetisiinternal = \App\kompetisiinternal::find($id);
        $kompetisiinternal->status = '1';
        $kompetisiinternal->save();
        noty()->flash('Yay!', 'Your data has been approve');
        return redirect('/approvekompetisi');
    }

         public function approvestatus2($id)
    {
        $kompetisiinternal = \App\kompetisiinternal::find($id);
        $kompetisiinternal->status = '0';
        $kompetisiinternal->save();

        noty()->flash('Yay!', 'Your data has been disapproved');
        return redirect()->back();
    }


    public function fileUpload($id)
    {
        $kompetisiinternal = \App\kompetisiinternal::find($id);
        $files = FileKompetisiInternal::where('kompetisiinternal_id', $id)->get();

        return view('/kompetisiinternal/fileupload', compact('files', 'kompetisiinternal'));
    }   

    public function doUpload($id)
    {
        $kompetisiinternal = \App\kompetisiinternal::find($id);

        $files = request()->file('files');

        if(request()->hasfile('files')){
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $file->move('kompetisiinternal/', $filename);

                FileKompetisiInternal::create([
                    'kompetisiinternal_id' => $kompetisiinternal->id,
                    'file' => 'kompetisiinternal/' . $filename
                ]);
            }
        }

        noty()->flash('Hey', 'Upload file success');
        return redirect()->back();
    }   

    public function removeFile($id)
    {
        FileKompetisiInternal::find($id)->delete();

        noty()->flash('Hey', 'Remove file success');
        return redirect()->back();
    }   
        public function approvestatuskompetisiall()
    {
        $approveId = request('approveId');
        $kompetisiinternal = \App\kompetisiinternal::whereIn('id', $approveId)->get();

        foreach ($kompetisiinternal as $kompetisiinternalrow) {
    // Code Here
         $kompetisiinternalrow->status = '1';
         $kompetisiinternalrow->save();
        }
        
        noty()->flash('Yay!', 'All your data has been approved');
        return redirect()->back();
    }
}
