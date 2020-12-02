<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    //
     protected $table = 'kegiatan';
     protected $fillable = ['poster','nama_kegiatan','tanggal_kegiatan','ormawa_id','deskripsi_kegiatan','sertifikat','status','file_sertifikat'];

     // public function ormawa()
     // {
     // 	# code...
     // }
 }
