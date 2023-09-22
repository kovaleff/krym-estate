<?php

namespace App\Http\Livewire;

use App\Jobs\ParseApartsForDeveloper;
use App\Models\Developer;
use App\Services\PersistParse;
use Livewire\Component;

class ApartParser extends Component
{

    public PersistParse $persistParse;

    public function render()
    {
        return view('livewire.apart-parser');
    }

    function parse(){

//        $developer = Developer::find(1);
//        ParseApartsForDeveloper::dispatch($developer);

        $developers = Developer::all();
        foreach ($developers as $developer){
            $job = ParseApartsForDeveloper::dispatch($developer);
        }
    }
    function parseTruncate(){
        $persistParse = new PersistParse();
        $persistParse->truncateApartsTable();
        $persistParse->truncateApartsImagesTable();
        $this->parse();
    }
}
