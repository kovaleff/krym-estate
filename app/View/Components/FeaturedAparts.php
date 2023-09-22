<?php

namespace App\View\Components;

use App\Models\Apart;
use App\Models\News;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class FeaturedAparts extends Component
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
        $photos = [];
        $currentYear = date("Y");
        $nextYear = $currentYear+1;
        $apartsThisYear = Apart::whereJsonContains('attr->Год сдачи', $currentYear)->inRandomOrder()->take(2)->get();
        $apartsNextYear = Apart::whereJsonContains('attr->Год сдачи', (string)$nextYear)->inRandomOrder()->take(2)->get();

        foreach($apartsNextYear->merge($apartsThisYear) as $apart){
            $photos[] = $apart->images->first();
        };
        $featuredApartPhotos = collect($photos);

        return view('components.featured-aparts', ['featuredApartPhotos' => $featuredApartPhotos]);
    }
}
