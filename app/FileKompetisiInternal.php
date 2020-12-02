<?php

namespace App;

use App\kompetisiinternal;
use Illuminate\Database\Eloquent\Model;

class FileKompetisiInternal extends Model
{
    protected $guarded = [];

    public function kompetisiinternal()
    {
    	return $this->belongsTo(kompetisiinternal::class);
    }
}
