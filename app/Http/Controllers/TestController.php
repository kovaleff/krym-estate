<?php

namespace App\Http\Controllers;

use App\Jobs\ParseApartsForDeveloper;
use App\Models\Developer;
use App\Services\ParserRegexp;
use Illuminate\Http\Request;

class TestController extends Controller
{
    function index(ParserRegexp $parser){
        $parser->clearApartsAndPhotosTables();

        $developers = Developer::all();
        foreach ($developers as $developer){
            $job = ParseApartsForDeveloper::dispatch($developer);
        }
    }
}
