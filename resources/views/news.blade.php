@extends('layouts.main')
@section('pageTitle', 'Застройщики Крыма')
@section('content')


    <!-- Content -->
    <section id="content">
        <div class="container news">
            <h1 class="news-title">Новости:</h1>
            <div class="row align-center">
                <ul class="col-12-medium">
                @foreach ($news as $newsItem)
                    <li class="news-item">
                        <a  class="flex align-center" href="{{route('news', $newsItem->id)}}">
                            @if($newsItem->developer) <img src="/storage/{{$newsItem->developer->image}}" height="100px"> @endif
                            <span>{{$newsItem->title}}</span>
                        </a>
                    </li>
                @endforeach
                </ul>
            </div>
            <div class="row pagination">
                {{ $news->links('vendor.pagination.default') }}
            </div>
        </div>
    </section>
@endsection
