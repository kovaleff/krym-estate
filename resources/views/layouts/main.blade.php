<!DOCTYPE HTML>
<html>
<head>
    <title>Krym-estate - @yield('pageTitle')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

    <meta name="format-detection" content="telephone=no">
    <meta name="description" content="Недвижимость, застройщики, каталог новостроек и бизнес-центров Крыма.">
    <meta name="keywords" content="застройщики, застройщики Крыма, новые застройщики, продажа новостроек от застройщика, сайты застройщиков, застройщики эконом класс, официальный сайт застройщика, застройщики компании, список застройщиков, заказчик застройщик,  застройщик комплекса, застройщик жилого комплекса, недорогие застройщики">

    <meta property="og:type" content="website">
    <meta property="og:title" content="Застройщики Крыма">
    <meta property="og:description" content="Подробное описание застройщиков, список всех объектов, сайты застройщиков.">
    <meta property="og:url" content="{{url()->full()}}">

    <link rel="canonical" href="{{url()->full()}}">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(95007871, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/95007871" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-KQM3JVE7NB"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-KQM3JVE7NB');
    </script>
</head>
<body>
<div id="page-wrapper">

    <!-- Header -->
    <section id="header">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <!-- Logo -->
                    <h1><a href="/" id="logo"><span>K</span>rym-<span>e</span>state</a></h1>

                    <!-- Nav -->
                    <nav id="nav">
                        <a href="/">Домой!</a>
                        <a href="/developers">Застройщики</a>
                        <a href="/all-news">Новости</a>
                    </nav>

                </div>
            </div>
        </div>
        <div id="banner">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-12-medium">
                        <x-latest-news></x-latest-news>
                    </div>
                    <div class="col-6 col-12-medium imp-medium">

                        <!-- Banner Image -->
                        <a href="/" class="bordered-feature-image"><img src="/images/banner.jpg" alt="" /></a>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features -->
    <section id="features">
        <div class="container">
            <div class="row">
                <x-featured-aparts></x-featured-aparts>
            </div>
        </div>
    </section>

        @yield('content')

    <!-- Copyright -->
    <div id="copyright">
        &copy; Design: <a target="_blank" href="https://best-devs.ru">best-devs.ru</a>
    </div>

</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

@stack('scripts')

</body>
</html>
