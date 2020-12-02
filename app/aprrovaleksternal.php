<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class aprrovaleksternal extends Model
{
    //
    protected $table = 'approvaleksternal';
    protected $fillable = ['kompetisi_id','ormawa_id','status'];
}
