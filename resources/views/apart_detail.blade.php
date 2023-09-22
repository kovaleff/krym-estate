@extends('layouts.main')
@section('pageTitle', $apart->title)
@section('content')
			<!-- Content -->
				<section id="content" class="content-apart">
					<div class="container">
						<div class="row">
							<div class="col-9 col-12-medium">
								<!-- Main Content -->
									<section class="apart-detail">
                                        <h1>{{$apart->title}}</h1>

                                        <div class="container">

                                            @foreach ($apart->images as $image)
                                                <div class="mySlides">
                                                    <img src="/storage/{{$image->image}}" style="width:100%">
                                                </div>
                                            @endforeach

                                            <a class="prev" onclick="plusSlides(-1)">❮</a>
                                            <a class="next" onclick="plusSlides(1)">❯</a>

{{--                                            <div class="caption-container">--}}
{{--                                                <p id="caption"></p>--}}
{{--                                            </div>--}}

                                            <div class="row">
                                                @foreach ($apart->images->take(12) as $i=>$image)
                                                    <div class="column">
                                                        <img class="demo cursor" src="/storage/{{$image->image}}" style="width:100%" onclick="currentSlide({{$i}})" alt="The Woods">
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>

                                        <h1>Основные характеристики:</h1>
                                        <ul class="apart_attr">
                                            @foreach ($apart->attr as $i=>$attr)
                                                <li>
                                                    <b>{{$i}}</b> : {{$attr}}
                                                </li>
                                            @endforeach
                                        </ul>

                                    </section>
							</div>
							<div class="col-3 col-12-medium">

								<!-- Sidebar -->
									<section>
										<div class="adv_block"></div>
									    <div class="apart-developer flex flex-column">
                                            <div class="flex align-center space-evenly">
                                                <h1>Застройщик <br/> <a href="{{ route('developer',  $apart->developer->id) }}">{{$apart->developer->title}}</a></h1>
                                                <img src="/storage/{{$apart->developer->image}}" alt="{{$apart->developer->title}}" width="100px">
                                            </div>
                                            <div class="apart-developer-phone flex justify-center">
                                                <a href="tel:{{$apart->developer->phone}}">{{$apart->developer->phone}}</a>
                                            </div>
                                            <div class="apart-developer-site flex justify-center">
                                                <a target="_blank" href="{{$apart->developer->siteurl}}"><b>{{trim($apart->developer->siteurl,'/')}}</b></a>
                                            </div>

                                        </div>
									</section>
									<section>
										<header>
{{--											<h2>Ipsum Dolor</h2>--}}
                                            @livewire('currency-widget')
										</header>
									</section>
							</div>
						</div>
					</div>
				</section>

@endsection
<style>

    .mySlides {
        display: none;
    }


    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 40%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /*!* Number text (1/3 etc) *!*/
    /*.numbertext {*/
    /*    color: #f2f2f2;*/
    /*    font-size: 12px;*/
    /*    padding: 8px 12px;*/
    /*    position: absolute;*/
    /*    top: 0;*/
    /*}*/

    /* Container for image text */
    /*.caption-container {*/
    /*    text-align: center;*/
    /*    background-color: #222;*/
    /*    padding: 2px 16px;*/
    /*    color: white;*/
    /*}*/

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Six columns side by side */
    .column {
        float: left;
        width: 16.66%;
    }

    /* Add a transparency effect for thumnbail images */
    .demo {
        opacity: 0.6;
    }

    .active,
    .demo:hover {
        opacity: 1;
    }
</style>
@push('scripts')
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("demo");
            let captionText = document.getElementById("caption");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
            // captionText.innerHTML = dots[slideIndex-1].alt;
        }
    </script>
@endpush
