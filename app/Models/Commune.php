<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $table = 'communes';

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }
}
