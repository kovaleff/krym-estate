<?php

namespace App\View\Components;

use App\Models\News;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class LatestNews extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $newsLatest = Cache::remember('latest-news', 3600, function () {
            return News::latest()->take(5)->get();
        });

        return view('components.latest-news', ['newsLatest' =>$newsLatest]);
    }
}
