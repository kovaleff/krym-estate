<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    function detail($id){
        $developer = Developer::findOrFail($id);
        return view('developer_detail', [
            'developer' => $developer,
        ]);
    }
    function all(){
        $developers = Developer::where('image', '<>', 'developers/no-logo.jpg')->orderBy('is_featured', 'desc')->paginate(9);
        return view('developers', [
            'developers' => $developers,
        ]);
    }
}
