<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prodi extends Model
{
    protected $guarded = [];

    protected $table = 'prodi';

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
