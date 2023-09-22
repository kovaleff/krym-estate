<?php

namespace App\Http\Livewire;

use App\Models\Scanjob;
use App\Services\ParserInterface;
use App\Services\ParserRegexp;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class DeveloperParser extends Component
{
    private ParserRegexp $parser;
    public int $percentDone = 0;

    public function render()
    {
        $this->percentDone = Scanjob::where('type','developers')->firstOrFail()->percents;
        return view('livewire.developer-parser', ['percentDone' => $this->percentDone]);
    }

    function parse($truncate = false){
        $this->parser = new ParserRegexp();
        $this->parseDevelopers($truncate);
        //$this->done = true;
    }

    function parseDevelopers($truncate)
    {
        $this->parser->parseDevelopers(false, $truncate);
    }
}
