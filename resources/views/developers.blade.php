@extends('layouts.main')
@section('pageTitle', 'Застройщики Крыма')
@section('content')


    <!-- Content -->
    <section id="content">
        <div class="container developers">
            <h1 class="developer-title">Застройщики:</h1>
            <div class="row align-center justify-center">
                @foreach ($developers as $developer)
                <div class="col-4 col-12-medium">
                    <section class="flex flex-column align-center justify-center developer-home">
                        <header>
                            <a href="/developer/{{$developer->id}}"><h2>{{$developer->title}}</h2></a>
                            <a href="/developer/{{$developer->id}}"><h3>{{$developer->content}}</h3></a>
                        </header>
                        <a href="/developer/{{$developer->id}}" class="developer-logo">
                            <img src="storage/{{$developer->image}}" alt="{{$developer->title}}" /></a>
                        <p>
                            <a target="_blank" href="{{$developer->siteurl}}" class="developer-url">{{trim( mb_convert_encoding($developer->siteurl, 'UTF-8', 'auto'), '\/')}}</a>
                        </p>
                    </section>
                </div>
                @endforeach
            </div>
            <div class="row pagination">
                {{ $developers->links('vendor.pagination.default') }}
            </div>
        </div>
    </section>
@endsection
