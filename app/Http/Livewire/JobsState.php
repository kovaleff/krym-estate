<?php

namespace App\Http\Livewire;

use App\Models\Job;
use Livewire\Component;

class JobsState extends Component
{
    public $jobs;

    public function render()
    {
        $this->jobs = Job::all();
        return view('livewire.jobs-state', ['jobs' => $this->jobs]);
    }
}
