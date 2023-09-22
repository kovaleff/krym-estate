@extends('layouts.main')
@section('pageTitle', $developer->title)
@section('content')
			<!-- Content -->
				<section id="content" class="content-developer">
					<div class="container">
						<div class="row">
							<div class="col-9 col-12-medium">
								<!-- Main Content -->
									<section class="developer-detail">
                                        <h1>{{$developer->title}}</h1>
                                        <div class="row flex">
                                            <div class="col-6">
                                                <img src="/storage/{{$developer->image}}" alt="">
                                            </div>
                                            <div class="col-6">
                                                <div>{{$developer->founded}}</div>
                                                <div>{{$developer->phone}}</div>
                                                <div><a href="{{$developer->siteurl}}">{{trim($developer->siteurl,'/')}}</a></div>
                                                <div>{{$developer->regions}}</div>
                                            </div>
                                        </div>

                                        <div class="developer-aparts">
                                            @foreach ($developer->aparts as $apart)
                                                <div class="apart">
                                                    <a href="/apart/{{$apart->id}}"><img src="/storage/{{$apart->images->first()->image}}" style="width:200px"></a>
                                                </div>
                                                <div class="apart-link">
                                                    {{$apart->content}}
                                                </div>
                                                <div class="apart-link">
                                                    {{$apart->city}}
                                                </div>
                                                <div class="apart-link">
                                                    {{$apart->phone}}
                                                </div>
                                                <div class="apart-link">
                                                    {{$apart->address}}
                                                </div>
                                                <div class="apart-link">
                                                    {{$apart->content}}
                                                </div>
                                            @endforeach
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


