<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kompetisiinternal extends Model
{
    //
      protected $table = 'kompetisiinternal';
      protected $fillable = ['poster','ormawa_id','user_id','nama_kompetisi','jenis_kompetisi','url','sertifikat','file_sertifikat','skala','pencapaian','nama_kegiatan','tanggal_kegiatan','penyelenggara','status'];
}
