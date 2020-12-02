<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class aprrovalinternal extends Model
{
    //
    protected $table = 'approvaleksternal';
    protected $fillable = ['user_id','kompetisi_id','ormawa_id','status'];
}
