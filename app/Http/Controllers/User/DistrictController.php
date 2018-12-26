<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    public function getAllRecord()
    {
        $districts = \App\Models\Province::find($_POST['provinceId'])->districts;

        return \Response::json($districts);
    }
}
