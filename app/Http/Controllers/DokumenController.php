<?php

namespace App\Http\Controllers;

use App\Ormawa;
use App\Skpi;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use PhpOffice\PhpWord\PhpWord;


class DokumenController extends Controller
{
    //
    public function worddownload()
    {
    	$phpWord = new PhpWord();

		$section = $phpWord->addSection();
		
		$data = $this->dataBasedOnPermission();                     
		Date::setLocale('id');

        foreach($data as $index => $skpi) {
        	$dateFormat = Date::parse($skpi->tanggal_dokumen)->format('d F Y');
            $glue = $index + 1 . '.'. ' '. $skpi->user->name . ' - ' . $skpi->judul_sertifikat . ', '. $dateFormat. ', ' . $skpi->penyelenggara;
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
		} else if($role == 'Ormawa') {
			$ormawaId = Ormawa::where('user_id', auth()->user()->id)->first();
			$data = Skpi::where('ormawa_id', $ormawaId->id)->get();
		} else {
			$data = Skpi::where('user_id', auth()->user()->id)->get();
		}

		return $data;
    }
}
