<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class CommuneController extends Controller
{
    public function getAllRecord()
    {
        $communes = \App\Models\District::find($_POST['districtId'])->communes;

        return \Response::json($communes);
    }
}
