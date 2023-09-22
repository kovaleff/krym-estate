<?php

namespace App\Http\Controllers;

use App\Models\ApartPhoto;
use App\Models\Developer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        $developersRandom = Developer::where('is_visible', true)->inRandomOrder()->limit(9)->get();
        return view('home', [
            'developersRandom' => $developersRandom,
        ]);
    }

}
