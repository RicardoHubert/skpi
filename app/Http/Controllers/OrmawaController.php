<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use\App\Ormawa;
use\App\User;
class OrmawaController extends Controller
{
    //
    public function index(Request $request)
    {
        # code...
        
        if($request->has('cari')){
            $data_ormawa = \App\Ormawa::where('nama_ormawa','LIKE','%'.$request->cari. '%')->get();
        }else{
            $data_ormawa = \App\Ormawa::all();
        }
        
        return view('ormawa.index',['data_ormawa' => $data_ormawa]);
    }
    public function create(Request $request)
    {
        # code...
        # Insert Ke table user
        $user = new \App\User;
        $user->name = $request->nama_ormawa;
        $user->role = 'Ormawa';
        $user->email = $request->email;
        $user->password = bcrypt('admormawa');
        $user->remember_token = str::random(60);
        $user->save();

        // Insert ke table ormawa
        $request->request->add(['user_id' => $user->id]);
        $ormawa = \App\Ormawa::create($request->all());
        

        if($request->hasfile('logo_ormawa')){
            $request->file('logo_ormawa')->move('logo/',$request->file('logo_ormawa')->getClientOriginalName());
            $ormawa->logo_ormawa = $request->file('logo_ormawa')->getClientOriginalName();
            $ormawa->save();

        }

          if($request->hasfile('bg_ormawa')){
            $request->file('bg_ormawa')->move('bg_ormawa/',$request->file('bg_ormawa')->getClientOriginalName());
            $ormawa->bg_ormawa = $request->file('bg_ormawa')->getClientOriginalName();
            $ormawa->save();

        }

        return redirect('/ormawa')->with('sukses','Data berhasil diinput');
    }
    

    public function edit($id)
    {
        # code...
        $ormawa = \App\Ormawa::find($id);
        return view('ormawa/edit',['ormawa' => $ormawa]);
    }
    public function update(Request $request,$id)
    {
        # code...
        //dd($request->all());
        $ormawa = \App\Ormawa::find($id);

        $ormawa->update($request->all());
        if($request->hasfile('logo_ormawa')){
            $request->file('logo_ormawa')->move('logo/',$request->file('logo_ormawa')->getClientOriginalName());
            $ormawa->logo_ormawa = $request->file('logo_ormawa')->getClientOriginalName();
            $ormawa->save();

        }
        return redirect('/ormawa')->with('sukses','Data berhasil di updates');
    }

    public function delete(Request $request,$id)
    {
        # code..

        $ormawa = Ormawa::find($id);
        $ormawa->delete($ormawa->id);
        User::find($ormawa->user_id)->delete();
        return redirect('/ormawa')->with('sukses','Data berhasil di Hapus');
    } 
    public function profile($id){
        $ormawa = \App\Ormawa::find($id);
        return view('ormawa.profile',['ormawa' => $ormawa]);
    }     
}
