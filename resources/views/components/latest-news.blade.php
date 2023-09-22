<div class="developer-news">
    <ul class="check-list">
        @foreach ($newsLatest as $newsItem)
            <li><a alt="{{$newsItem->title}}" href="{{route('news',$newsItem->id)}}">{{$newsItem->title}}</a></li>
        @endforeach
    </ul>
</div>
