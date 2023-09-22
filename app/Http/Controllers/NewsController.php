<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    function index(){
        //$news = News::orderBy('published_at', 'desc')->paginate(10);
        $news = Cache::remember('all-news', 3600, function () {
            return News::orderBy('published_at', 'desc')->paginate(10);
        });

        return view('news', [
            'news' => $news,
        ]);
    }

    function detail($id){
        $newsItem = News::findOrFail($id);

        return view('news_detail', [
            'newsItem'=>$newsItem,
        ]);
    }
}
