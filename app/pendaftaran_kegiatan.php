<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pendaftaran_kegiatan extends Model
{
    //
        protected $table = 'pendaftaran_kegiatan';
    	protected $fillable = ['kegiatan_id','nama','nim','jurusan','email','no_telp','asal_kampus'];
}
