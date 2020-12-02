<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Skpi;
use Jenssegers\Date\Date;
use App\User;
use MCGalih\Serti\Sertifikat;
use Carbon\Carbon;
use App\Prodi;
use Storage;

class KalbiserController extends Controller
{
    //
     public function index(Request $request){
     $data_kalbiser = \App\kalbiser::all();
     $prodi = \App\Prodi::all();
      return view('kalbiser.index',['data_kalbiser' => $data_kalbiser, 'prodi' => $prodi]);
     }

      public function create(Request $request)
    {
        # code...
        $exist = User::where('email', request('email'))->first();
        if($exist) {
          noty()->danger('Whops', 'Email already exist');
          return redirect()->back();
        }
           # Insert Ke table user
        $user = new \App\User;
        $user->name = $request->nama;
        $user->role = 'student';
        $user->email = $request->email;
        $user->password = bcrypt('12345');
        $user->remember_token = str::random(60);
        $user->save();

        #insert ke table kalbiser
       $request->request->add(['user_id' => $user->id]);
       $kalbiser=\App\kalbiser::create($request->all());
       if($request->hasfile('foto')){
       $request->file('foto')->move('fotokalbiser/',$request->file('foto')->getClientOriginalName());
       $kalbiser->foto = $request->file('foto')->getClientOriginalName();
       $kalbiser->save();
   		}

      
       return redirect('/kalbiser')->with('sukses','Data berhasil diinput');
        }

  	public function edit($id)
    {
        # code...
        $kalbiser = \App\kalbiser::find($id);
         $prodi = \App\Prodi::all();
         $user = \App\User::all();
        return view('kalbiser/edit',['kalbiser' => $kalbiser, 'prodi' => $prodi, 'user' => $user]);
    }
    public function update(Request $request,$id)
    {
        # code...
        //dd($request->all());

        $kalbiser = \App\kalbiser::find($id);
        $user = \App\User::find($id);
        $kalbiser->update($request->all());

        // Edit table user
      

      	if($request->hasfile('foto')){
            $request->file('foto')->move('fotokalbiser/',$request->file('foto')->getClientOriginalName());
            $kalbiser->foto = $request->file('foto')->getClientOriginalName();
            $kalbiser->save();

        }
        return redirect('/kalbiser')->with('sukses','Data berhasil di updates');
    }
     public function delete(Request $request,$id)
    {
        # code..
        $kalbiser = \App\kalbiser::find($id);
        $kalbiser->delete($kalbiser);
       User::find($kalbiser->user_id)->delete();

        return redirect('/kalbiser')->with('sukses','Data berhasil di Hapus');
    }

    public function profile($id){
        $kalbiser = \App\kalbiser::find($id);
        $users = \App\User::all();
        return view('kalbiser.profile', ['kalbiser' => $kalbiser, 'users' => $users]);
    }


      public function wordkalbiser()
    {
    $phpWord = new \PhpOffice\PhpWord\PhpWord();

    $section = $phpWord->addSection();

    $data = $this->dataBasedOnPermission();
    Date::setLocale('id');

        foreach($data as $index => $skpi) {
          $dateFormat = Date::parse($skpi->tanggal_dokumen)->format('d F Y');
            $glue = $index + 1 . '.'. ' '. $skpi->user->name . ' - ' . $skpi->judul_sertifikat . ', '. $dateFormat. ', ' . $skpi->penyelenggara . ',' . $skpi->nomor_file;
            $section->addText($glue);
    }

    // Saving the document as OOXML file...
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save('helloWorld.docx');

        return response()->download(public_path('helloWorld.docx'));

    }

    private function dataBasedOnPermission()
    {
      $data = [];
      $role = auth()->user()->role;

      // Admin
      if($role == 'admin') {
        $data = Skpi::all();
      } 
      else if($role == 'Ormawa') {
        $ormawaId = Ormawa::where('user_id', auth()->user()->id)->first();
        $data = Skpi::where('ormawa_id', $ormawaId->id)->get();
      } 
      else {
        $data = Skpi::where('user_id', auth()->user()->id)->get();
      }

      return $data;
    }

   
    public function print_skpi_list($id){
        $skpis = \App\kalbiser::find($id)
                    ->skpi()
                    ->where("status", "<>", 0)
                    ->get();

        if($skpis->count() == 0) {
          noty()->danger('Whops', 'File is empty');
          return back();
        }

        $sertifikat = new Sertifikat(storage_path("app/template/blangko.jpg"));
        $initialYLoc = 500; // X Location
        $xLoc = 1240/5; // Y Location
        $idx = 1;
        foreach($skpis as $skpi){
            $sertifikat->text($idx++.". ".$skpi->judul_sertifikat.", ". Carbon::make($skpi->tanggal_dokumen)->locale("id")->isoFormat("DD MMMM YYYY"), [$xLoc, $initialYLoc], [
                "file" => "@app/fonts/arial.ttf",
                "size" => 46,
                "align" => "left"
            ]);
            $initialYLoc += 60; // Increment per lists
        }

        return response($sertifikat->image()->encode("jpg"))
                    ->header("Content-Type", "image/jpg");
  }
}
