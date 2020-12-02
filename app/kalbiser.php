<?php

namespace App;

use App\prodi;
use Illuminate\Database\Eloquent\Model;

class kalbiser extends Model
{
    //
    protected $table = 'kalbiser';
    protected $fillable = ['nama','nim','prodi_id','foto','nohp','email','user_id','tahun_akademik'];

    public function skpi(){
        return $this->hasMany(skpi::class, "user_id", "user_id");
    }

    public function prodi()
    {
    	return $this->belongsTo(prodi::class);
    }

}
