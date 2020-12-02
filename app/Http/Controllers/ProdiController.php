<?php

namespace App\Http\Controllers;

use App\User;
use App\kalbiser;
use App\skpi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use\App\Prodi;

class ProdiController extends Controller
{
    //
    public function index(Request $request)
    {
        # code...
        
        if($request->has('cari')){
            $data = \App\Prodi::where('nama','LIKE','%'.$request->cari. '%')->get();
        }else{
            $data = \App\Prodi::all();
        }
        
        return view('prodi.index',['data' => $data]);
    }
    public function create(Request $request)
    {
        # code...
        # Insert Ke table user
        $user = new \App\User;
        $user->name = $request->nama_prodi;
        $user->role = 'Prodi';
        $user->email = $request->email;
        $user->password = bcrypt('admprodi');
        $user->remember_token = str::random(60);
        $user->save();

        // Insert ke table ormawa
        $prodi = \App\Prodi::create([
            'user_id' => $user->id,
            'nama_prodi' => request('nama_prodi')
        ]);
        
        return redirect('/prodi')->with('sukses','Data berhasil diinput');
    }
    

    public function edit($id)
    {
        # code...
        $prodi = \App\Prodi::find($id);
        return view('prodi/edit',['prodi' => $prodi]);
    }
    public function update(Request $request,$id)
    {
        $prodi = \App\prodi::find($id);
        $prodi->update($request->all());
        return redirect('/prodi')->with('sukses','Data berhasil di updates');
    }

    public function delete(Request $request,$id)
    {
        # code..
        // Delete data dari prodi dan user
        $prodi = Prodi::find($id);
        User::find($prodi->user_id)->delete();
        $prodi->delete();
        return redirect('/prodi')->with('sukses','Data berhasil di Hapus');
    } 

    public function approve()
    {
        $prodi = prodi::where('user_id', auth()->user()->id)->first();
        $kalbisers = kalbiser::where('prodi_id', $prodi->id)->get()->pluck('user_id');
        $data = skpi::whereIn('user_id', $kalbisers)->get();
        return view('approveprodi.index', compact('data'));
    }
}
