<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    //
    protected $table = 'dokumen';
    protected $fillable = ['nama_dokumen','jenis_dokumen','deskripsi_dokumen','file_unggah'];
}
}
