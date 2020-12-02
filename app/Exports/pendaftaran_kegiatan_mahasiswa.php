<?php

namespace App\Exports;

use App\pendaftaran_kegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;


class pendaftaran_kegiatan_mahasiswa implements FromCollection,ShouldAutoSize,WithHeadings,WithMapping,WithColumnFormatting,WithEvents
{

  public $kegiatanId;

  public function __construct($kegiatanId)
  {
    $this->kegiatanId = $kegiatanId;
  }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return pendaftaran_kegiatan::where('kegiatan_id', $this->kegiatanId)->get();
    }

     public function headings(): array
    {

        return ['kegiatan_id','nama','nim','jurusan','email','no_telp','asal_kampus','Updated_at',
        ];

    }

     public function map($pendaftaran_kegiatan): array
    {
        return [
          $pendaftaran_kegiatan->kegiatan_id,
        	$pendaftaran_kegiatan->nama,
        	$pendaftaran_kegiatan->nim,
        	$pendaftaran_kegiatan->jurusan,
        	$pendaftaran_kegiatan->email,
        	$pendaftaran_kegiatan->no_telp,
          $pendaftaran_kegiatan->asal_kampus,
        	Date::dateTimeToExcel($pendaftaran_kegiatan->updated_at),
        ];
    }

      public function columnFormats(): array
    {
        return [
            'AD' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function registerEvents(): array
       {
           return [
               AfterSheet::class => function(AfterSheet $event) {
               	// Merge Cells
                   $event->sheet->getDelegate()->freezePane('A2');
   
                   $event->sheet->getDelegate()->getStyle('A1:AD1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                   // $event->sheet->getDelegate()->getStyle('B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');
                   // $event->sheet->getDelegate()->getStyle('V1:W1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');
                   // $event->sheet->getDelegate()->getStyle('G1:M1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                   // $event->sheet->getDelegate()->getStyle('N1:Q1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('00FFFF');
                   // $event->sheet->getDelegate()->getStyle('S1:U1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                   $event->sheet->getDelegate()->getStyle('A1:AD1')->getFont()->setBold(true);
                   // $event->sheet->getDelegate()->getStyle('B1')->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );
                   // $event->sheet->getDelegate()->getStyle('V1:W1')->getFont()->setColor( new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE ) );

                   $event->sheet->getRowDimension('1')->setRowHeight(20);
                   
               },
           ];
       }

}
