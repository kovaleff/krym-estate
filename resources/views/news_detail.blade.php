@extends('layouts.main')
@section('pageTitle', $newsItem->title)
@section('content')
			<!-- Content -->
				<section id="content" class="content-news">
					<div class="container">
						<div class="row">
							<div class="col-9 col-12-medium">
								<!-- Main Content -->
									<section class="news-detail">
                                        <div class="news-title flex align-center justify-center">
                                            <img src="/storage/{{$newsItem->developer?->image}}">
                                            <h1>{{$newsItem->title}}  <small>({{ Carbon\Carbon::createFromFormat('Y-m-d', $newsItem->published_at)->format('d.m.Y') }})</small></h1></div>

                                        <div class="news-detail">
                                            {!! $newsItem->content !!}
                                        </div>
                                    </section>
							</div>
							<div class="col-3 col-12-medium">

								<!-- Sidebar -->
{{--									<section>--}}
{{--										<header>--}}
{{--											<h2>Advert here!!!</h2>--}}
{{--										</header>--}}
{{--									</section>--}}
									<section>
										<header>
                                            @livewire('currency-widget')
										</header>

									</section>

							</div>
						</div>
					</div>
				</section>

@endsection


