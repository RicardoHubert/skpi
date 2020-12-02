<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ormawa extends Model
{
    //
     protected $table = 'ormawa';
     protected $fillable = ['logo_ormawa', 'bg_ormawa','nama_ormawa','kategori_ormawa','visi','misi','email','user_id'];

     public function getAvatar(){
     	if(!$this->logo_ormawa){
     		return asset('logo/default.png');
     	}else{

     	return asset('logo/'. $this->logo_ormawa);
     }
}
}
