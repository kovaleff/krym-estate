@extends('layouts.main')
@section('pageTitle', 'Застройщики Крыма')
@section('content')


    <!-- Content -->
    <section id="content">
        <div class="container home">
            <h1 class="developer-title">Застройщики:</h1>
            <div class="row aln-center">
                @foreach ($developersRandom as $developer)
                <div class="col-4 col-12-medium">
                    <section class="flex flex-column align-center justify-center developer-home">
                        <header>
                            <h2><a href="/developer/{{$developer->id}}">{{$developer->title}} </a></h2>
                            <h3>{{$developer->regions}}</h3>
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
        </div>
    </section>
@endsection
