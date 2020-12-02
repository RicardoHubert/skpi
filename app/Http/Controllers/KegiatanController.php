<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\pendaftaran_kegiatan_mahasiswa;
use App\Skpi as Skpi;
use Carbon\Carbon;
use Storage;
use MCGalih\Serti\Sertifikat as Sertifikat;

class KegiatanController extends Controller
{
    //
    public function index(Request $request)
    {
            # code...
        if($request->has('cari')){
            $data_ormawa = \App\Ormawa::where('nama_ormawa','LIKE','%'.$request->cari. '%')->get();
            $data_kegiatan = \App\Kegiatan::all();
            $paginate = \App\Kegiatan::paginate(3);
            // Untuk Relasi

        }else{
            $data_kegiatan = \App\Kegiatan::all();
            $paginate = \App\Kegiatan::paginate(3);
            // Untuk Relasi
            $data_ormawa = \App\Ormawa::all();
        }

  
        return view('kegiatan.index',['data_kegiatan' => $data_kegiatan,'data_ormawa' => $data_ormawa]);
    }

    public function create(Request $request)
    {
        # code...
        $kegiatan=\App\Kegiatan::create($request->all());
          // dd($kegiatan);
        if($request->hasfile('poster')){
            $file = $request->file('poster');
            $filename = $file->getClientOriginalName();
            $file->move('laravel/public/posterkegiatan/posterkegiatan/', $filename);

            $kegiatan->poster = 'laravel/public/posterkegiatan/posterkegiatan/' . $filename;
            $kegiatan->save();
        }


        
        return redirect('/kegiatan')->with('sukses','Data berhasil diinput');
    }

    public function edit($id)
    {
        # code...
        $kegiatan = \App\Kegiatan::find($id);
        $data_ormawa = \App\Ormawa::all();
        return view('kegiatan/edit',['kegiatan' => $kegiatan,'data_ormawa' => $data_ormawa]);
    }

    public function update(Request $request,$id)
    {
        # code...
        //dd($request->all());

        $data_ormawa = \App\Ormawa::find($id);

        $kegiatan = \App\Kegiatan::find($id);
        $kegiatan->update($request->all());
        if($request->hasfile('file_sertifikat')){
            $request->file('file_sertifikat')->move('file_sertifikat/',$request->file('file_sertifikat')->getClientOriginalName());
            $kegiatan->file_sertifikat = $request->file('file_sertifikat')->getClientOriginalName();
            $kegiatan->save();

        }
        if($request->hasfile('poster')){
            $file2 = $request->file('poster');
            $filename2 = $file2->getClientOriginalName();
            $file2->move('laravel/public/posterkegiatan/posterkegiatan/', $filename2);

            $kegiatan->poster = 'laravel/public/posterkegiatan/posterkegiatan/' . $filename2;
           
            
            // print_r($filename2);
            $kegiatan->save();

        }

        return redirect('/kegiatan')->with('sukses','Data berhasil di updates');
    }

    public function delete(Request $request,$id)
    {
        # code..
        $kegiatan = \App\Kegiatan::find($id);
        $kegiatan->delete($kegiatan);
        return redirect('/kegiatan')->with('sukses','Data berhasil di Hapus');
    }

    public function approveindex(Request $request)
    {
        # code...

        $kegiatan = \App\Kegiatan::all();
        $paginate = \App\Kegiatan::paginate(3);
        // Untuk Relasi
        $data_ormawa = \App\Ormawa::all();

        return view('approvekegiatan.index',['kegiatan' => $kegiatan,'data_ormawa' => $data_ormawa]);
    }

    public function approvestatus($id)
    {
        $kegiatan = \App\Kegiatan::find($id);
        $kegiatan->status = '1';
        $kegiatan->save();
        noty()->flash('Yay!', 'Your data has been approved');
        return redirect('/approvekegiatan');
    }

     public function approvestatus2($id)
    {
        $kegiatan = \App\Kegiatan::find($id);
        $kegiatan->status = '0';
        $kegiatan->save();

        noty()->flash('Yay!', 'Your data has been disapproved');
        return redirect()->back();
    }

    public function pendaftaran_kegiatan_index($id){
        $pendaftaran_kegiatan = \App\pendaftaran_kegiatan::all();
        $kegiatan = \App\Kegiatan::find($id);
        return view('pendaftaran_kegiatan.index',['pendaftaran_kegiatan' => $pendaftaran_kegiatan, 'kegiatan' => $kegiatan]);
    }

    public function pendaftaran_kegiatan_create(Request $request)
    {
        /**
         * Validasi
         */
        $pendaftaran_kegiatan=\App\pendaftaran_kegiatan::create($request->all());
        $kegiatan = \App\Kegiatan::all();
        $pendaftaran_kegiatan->save();
        return redirect()->route("kegiatan_anggota.index")->with('sukses','Data berhasil diinput');
    }

    public function data_anggota_ormawa_index(Request $request){
        $ormawas = \App\Ormawa::all();
        $kegiatan_anggotas = \App\Kegiatan::where('ormawa_id', request('ormawa_id'))->get();
        $users = \App\Kalbiser::all();
        $skpi = \App\Skpi::all();

        return view('kegiatan_anggota.index',[
            'ormawas'=> $ormawas,
            'kegiatan_anggotas' => $kegiatan_anggotas,
            'users' => $users,
            'skpi' => $skpi
        ]);
    }

    public function data_anggota_ormawa_post(Request $request){

        /**
         * Validasi
         */

        $kegiatan = \App\Kegiatan::find(request('kegiatan_id'));
        $kalbiser = \App\Kalbiser::find(request('kalbiser_id'));
        $ormawa = \App\Ormawa::find(request('ormawa_id'));
        

        // Generate Serifikat

        $carbon = Carbon::parse($kegiatan->tanggal_kegiatan);
        $tanggal = $carbon->locale("id")->isoFormat("D MMMM YYYY");
        $no_urut = Skpi::where("nomor_urut", "<>", 0)->max("nomor_urut");
        $no_terakhir = ($no_urut == null ? 999 : $no_urut )+1;
        $prefixed = str_repeat(0, 4-strlen($no_terakhir)).$no_terakhir;
        $nomor = "$prefixed/CSD-STF/".$this->integerToRoman($carbon->isoFormat("M"))."/".$carbon->isoFormat("YYYY")."";
        $normalized = preg_replace("/\/+/", "_", $nomor);

        $data = [
            "nomor" => "Nomor : $nomor",
            "nama" => $kalbiser->nama,
            "nim" => $kalbiser->nim,
            "sebagai" => "Peserta",
            "judul acara" => $kegiatan->sertifikat,
            "judul acara 2" => "Diselenggarakan oleh ".$ormawa->nama_ormawa,
            "tanggal" => "Jakarta,  $tanggal"
        ];

        $jsonFile = Storage::disk("local")->get("template/mapping.json");
        $mappings = Sertifikat::MapText($data, $jsonFile);
        $sertifikat = new Sertifikat(storage_path("app/template/file_sertif.jpg"));
        $sertifikat->json_mapping($mappings);
        $sertifikat->image()->save(public_path("sertifikat/$normalized.jpg"), 100);

        $skpi = Skpi::create([
            'user_id' => $kalbiser->user_id,
            'file_skpi' => "sertifikat/$normalized.jpg",
            'tanggal_dokumen' => request("tanggal_dokumen"),
            'jenis_dokumen' => request("jenis_dokumen"),
            'judul_sertifikat' => $kegiatan->sertifikat,
            'ormawa_id' => request('ormawa_id'),
            'penyelenggara' => request('penyelenggara'),
            'tahun' => request('tahun'),
            'nomor_urut' => $no_terakhir,
            'nomor_file' => $nomor
        ]);

        $skpi->save();

        noty()->success('Hey!', "Data berhasil disimpan");

        return redirect()->route("kegiatan_anggota.index")->with("message", "Sukses Menambah Data");
    }

    public function data_anggota_ormawa_create(Request $request){
        $kegiatan_anggota=\App\dataanggotaormawa::create($request->all());
        $kegiatan_anggota->save();
        return redirect('/kegiatan_anggota')->with('sukses','Data berhasil diinput');
    }

    private function integerToRoman($integer)
    {
        // Convert the integer into an integer (just to make sure)
        $integer = intval($integer);
        $result = '';

        // Create a lookup array that contains all of the Roman numerals.
        $lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100,
        'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4,
        'I' => 1);

        foreach($lookup as $roman => $value){
            // Determine the number of matches
            $matches = intval($integer/$value);

            // Add the same number of characters to the string
            $result .= str_repeat($roman,$matches);

            // Set the integer to be the remainder of the integer and the value
            $integer = $integer % $value;
        }

        // The Roman numeral should be built, return it
        return $result;
    }
        public function approvestatusall()
    {
        $approveId = request('approveId');
        $skpi = \App\Kegiatan::whereIn('id', $approveId)->get();

        foreach ($skpi as $skpirow) {
    // Code Here
         $skpirow->status = '1';
         $skpirow->save();
        }
        
        noty()->flash('Yay!', 'Your data has been approved');
        return redirect()->back();
    }

    public function tabelnosertif(Request $request){
     $data_kalbiser = \App\kalbiser::all();
     $data_kegiatan = \App\Kegiatan::all();
     $data_ormawa = \App\Ormawa::all();
     $data_skpi = \App\Skpi::all();
      return view('kegiatan.nosertif',['data_kalbiser' => $data_kalbiser, 'data_kegiatan' => $data_kegiatan,  'data_ormawa' => $data_ormawa, 'data_skpi' => $data_skpi]);
     }
}

