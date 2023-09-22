<?php

namespace App\Http\Controllers\Parse;

use App\Exports\DeveloperExport;
use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Services\ParserDOM;
use App\Services\ParserRegexp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ParseController extends Controller
{
    private ParserRegexp $parser;

    function __construct(ParserRegexp $parser)
    {
        $this->parser = $parser;
    }

    function parse()
    {
//        $this->parser->parseDevelopers();
          $aparts = $this->parser->parseAparts();

//        $developersDataObjs = $this->parseDevelopers($this->parser);
//        return Excel::download(new DeveloperExport($developersDataObjs), 'developers.xlsx');
//        $this->parseApartsForDevelopers();
    }

    function parseDevelopers()
    {
        $developerArray = $this->parser->parseDevelopers();
        if ($developerArray) {
            //remap data
            $developersDataObjs = array_map(function($el){
                return [
                    'title' => $el['title'],
                    'content' => $el['regions'],
                    'founded' => $el['founded'],
                    'siteurl' => $el['developer_site'],
                    'image' => $el['img'],
                    'developer_link' => $el['developer_link']
                ];
            }, $developerArray);

            foreach ($developersDataObjs as $dataObj) {
                $developer = new Developer($dataObj);
                $developer->save();
            }
            return $developersDataObjs;
        }
    }

    function parseApartsForDevelopers(){
        $developers = Developer::all();
        foreach ($developers as $developer) {
            $this->parseApart($developer);
        }
    }

    function parseApart(Developer $developer){
        $aparts = [];
        $devAparts = $this->parser->parseApartsList($developer->developer_link);
        if($devAparts){
            $aparts[$developer->id] = $devAparts;
        }

        dd($aparts);
    }
}
