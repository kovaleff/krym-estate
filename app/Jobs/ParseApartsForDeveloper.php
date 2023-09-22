<?php

namespace App\Jobs;

use App\Models\Developer;
use App\Services\ParserRegexp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ParseApartsForDeveloper implements ShouldQueue /*, ShouldBeUnique */
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;


    private Developer $developer;
    private ParserRegexp $parser;

    /**
     * Create a new job instance.
     */
    public function __construct(Developer $developer)
    {

        $this->developer = $developer;
        $this->parser = new ParserRegexp();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->parser->parseApartsForDeveloper($this->developer);
        } catch(\Exception $e){
            Log::error('parseApartsForDeveloper Error:'.$e->getMessage());
            $this->release(5);
        }

    }
}
