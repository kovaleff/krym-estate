<?php

namespace App\Http\Controllers;

use App\Models\Apart;
use App\Models\Developer;
use Illuminate\Http\Request;

class ApartController extends Controller
{
    function detail($id){
        $apart = Apart::findOrFail($id);
        return view('apart_detail', [
            'apart' => $apart,
        ]);
    }
}
