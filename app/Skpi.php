<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class skpi extends Model
{
    //
    protected $table = 'skpi';
    protected $guarded = [];
 
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
