<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dataanggotaormawa extends Model
{
    //
        protected $table = 'dataanggotaormawa';
    protected $fillable = ['user_id','ormawa_id','jabatan','periode'];
}
