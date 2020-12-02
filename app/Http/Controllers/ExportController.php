<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pendaftaran_kegiatan;
 
use App\Exports\pendaftaran_kegiatan_mahasiswa;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class ExportController extends Controller
{
    //
public function export_excel()
	{
		return Excel::download(new pendaftaran_kegiatan_mahasiswa(request()->kegiatanId), 'dataregisterkegiatan.xlsx');
	}
}
