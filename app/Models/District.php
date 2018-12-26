<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }

    public function communes()
    {
        return $this->hasMany('App\Models\Commune');
    }
}
