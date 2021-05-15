@extends('layout.default', [
    'header' =>false,
    'contentClass' => 'container-fluid'
])
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="/browser-icon.ico">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#000000">
    <meta name="description" content="Web site created using create-react-app">
    <link crossorigin=""
          href="https://fonts.googleapis.com/css2?family=Hind+Vadodara:wght@300;400;500;600;700&amp;display=swap"
          rel="stylesheet">
    <link crossorigin="" rel="stylesheet" href="/style.css">
    <link crossorigin="" rel="apple-touch-icon" href="/logo192.png">
    <link rel="manifest" href="/manifest.json">
    <title>Satya Wacana Konseling</title>
    <link href="/static/css/2.762fc1a0.chunk.css" rel="stylesheet">
    <link href="/static/css/main.adfdfad2.chunk.css" rel="stylesheet">
        {{-- Favicon --}}
        <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />
        <link rel="stylesheet" href="/css/owl.carousel.css" />
{{--        <link rel="stylesheet" href="/css/owl.theme.default.css" />--}}
{{--         Fonts--}}
        {{ Metronic::getGoogleFontsInclude() }}

    <link rel="stylesheet" href="/css/style.bundle.css">
    <link rel="stylesheet" href="/css/app.css">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            let userId = {{Session::get('userId')}};
        </script>
        @foreach (Metronic::initThemes() as $theme)
            <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet" type="text/css"/>
        @endforeach



    <style type="text/css">@import url(https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500);</style>
    <style type="text/css">
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }
        :root {
            --tooltip-backcolor: #424242;
            --tooltip-forecolor: #FAFAFA;
        }

        .fab-container {
            bottom: 10vh;
            position: fixed;
            margin: 1em;
            right: 8vw;
        }

        .fab-item {
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
            border-radius: 50%;
            border-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 56px;
            height: 56px;
            margin: 20px auto 0;
            position: relative;
            -webkit-transition: transform .1s ease-out, height 100ms ease, opacity 100ms ease;
            transition: transform .1s ease-out, height 100ms ease, opacity 100ms ease;
            text-decoration: none;
        }

        .fab-item:active,
        .fab-item:focus,
        .fab-item:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
            transition: box-shadow .2s ease;
            outline: none;
        }

        .fab-item:not(:last-child) {
            width: 40px;
            height: 0px;
            margin: 0px auto 0;
            opacity: 0;
            -webkit-transform: translateY(50px);
            -ms-transform: translateY(50px);
            transform: translateY(50px);
        }

        .fab-container:hover
        .fab-item:not(:last-child) {
            height: 40px;
            opacity: 1;
            -webkit-transform: none;
            -ms-transform: none;
            transform: none;
            margin: 15px auto 0;
        }

        .fab-item:not(:last-child) i {
            opacity: 0;
        }

        .fab-container:hover
        .fab-item:not(:last-child) i {
            opacity: 1;
        }

        .fab-item:nth-last-child(1) {
            -webkit-transition-delay: 25ms;
            transition-delay: 25ms;
            background-size: contain;
        }

        .fab-item:not(:last-child):nth-last-child(2) {
            -webkit-transition-delay: 50ms;
            transition-delay: 20ms;
            background-size: contain;
        }

        .fab-item:not(:last-child):nth-last-child(3) {
            -webkit-transition-delay: 75ms;
            transition-delay: 40ms;
            background-size: contain;
        }

        .fab-item:not(:last-child):nth-last-child(4) {
            -webkit-transition-delay: 100ms;
            transition-delay: 60ms;
            background-size: contain;
        }

        [tooltip]:before {
            bottom: 25%;
            font-family: arial;
            font-weight: 600;
            border-radius: 2px;
            background: var(--tooltip-backcolor);
            color: var(--tooltip-forecolor);
            content: attr(tooltip);
            font-size: 12px;
            visibility: hidden;
            opacity: 0;
            padding: 5px 7px;
            margin-right: 12px;
            position: absolute;
            right: 100%;
            white-space: nowrap;
        }

        [tooltip]:hover:before,
        [tooltip]:hover:after {
            visibility: visible;
            opacity: 1;
            transition: opacity .1s ease-in-out;
        }

        .fab-item:nth-last-child(1)[tooltip]:hover:before,
        .fab-item:nth-last-child(1)[tooltip]:hover:after {
            transition: opacity .1s step-end;
        }

        .fab-item.fab-rotate:active,
        .fab-item.fab-rotate:focus,
        .fab-item.fab-rotate:hover {
            transform: rotate(45deg);
            box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.19), 3px 3px 6px rgba(0, 0, 0, 0.23);
            transition: box-shadow .2s ease, transform .1s ease;
            outline: none;
        }

        .fab-item.fab-rotate:nth-last-child(1)[tooltip]:hover:before,
        .fab-item.fab-rotate:nth-last-child(1)[tooltip]:hover:after {
            transform: rotate(-45deg);
            bottom: -60%;
            right: 60%;
        }
    </style>
    <link rel="stylesheet" href="/css/landing.css">
</head>
<body >
<noscript>You need to enable JavaScript to run this app.</noscript>
@section('content')

<div id="root">
    <!-- Modal-->
    @include('pages.landing._modals')

    <div style="background-color: white;">
        <div>
            <div class="">
                <header class="header border-0 pr-0 pr-lg-24" id="kt_header">
                    <img src="/static/media/logo_baru.e44b41bb.svg" style="cursor: pointer;">
                    <nav class="">
                        <ul class="pb-0">
                            <li class="d-sm-none d-lg-block"><a href="#pengumuman">Pengumuman</a></li>
                            <li class="d-sm-none d-lg-block"><a href="#layanan">Layanan</a></li>
                            <li class="d-sm-none d-lg-block"><a href="#konselor">Konselor</a></li>
                            <li><a href="panduan">Panduan</a></li>
                            <li class="d-sm-none d-lg-block">
                                @if($user)
                                <a href="/dashboard" type="button" class="button px-8" style="height: 32px; background: rgb(78, 115, 223); color: white;">
                                    @if ($user->role == 'konseli')
                                    {{$user->details->nim}}
                                    @else
                                    @if ($user->role == 'konselor')
                                    {{explode(' ',($user->details->nama_konselor." "))[0]}}
                                    @endif
                                    @endif
                                </a>
                                @else
                                <a id="button__login" type="button" class="button undefined" value="Login" style="width: 120px; height: 32px; background: rgb(78, 115, 223); color: white;">Login</a>
                                @endif
                            </li>
                        </ul>
                    </nav>
                </header>
                <header class="header-mobile border-0" id="kt_header_mobile">
                    <div class="mobile-logo">
                        <img src="/static/media/logo_baru.e44b41bb.svg" style="cursor: pointer; height: 50%">
                    </div>
                    <a href="panduan" class="font-size-lg" style="color: #4e73df">Panduan</a>
                    {{-- <nav class="">
                        <ul class="pb-0">
                            <li>
                            </li>
                            <li class="d-sm-none d-lg-block">
                                @if($user)
                                <a href="/dashboard" type="button" class="button px-8" style="height: 32px; background: rgb(78, 115, 223); color: white;">
                                    @if ($user->role == 'konseli')
                                    {{$user->details->nim}}
                                    @else
                                    @if ($user->role == 'konselor')
                                    {{explode(' ',($user->details->nama_konselor." "))[0]}}
                                    @endif
                                    @endif
                                </a>
                                @else
                                <a id="button__login" type="button" class="button undefined" value="Login" style="width: 120px; height: 32px; background: rgb(78, 115, 223); color: white;">Login</a>
                                @endif
                            </li>
                        </ul>
                    </nav> --}}
                </header>
                <div id="layanan">
                    <div class="row p-6">
                        <div class="col-lg-8">
                            <div class="" >
                                <div class="display-4 font-weight-bolder">
                                    Panduan
                                </div>
                                <div class="w-80 ">
                                    <div class="yellow-bar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex flex-column align-items-center">
                                <div class="service-quote"><img
                                        src="/static/media/icon_landingpage_diskusi.3fc9f1d7.svg">Mendiskusikan
                                    masalahmu
                                </div>
                                <div class="service-description">Konselor di Satya Wacana Counseling akan selalu siap
                                    mendengarkan masalahmu dan berdiskusi untuk mendapatkan solusi terbaik.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex flex-column align-items-center">
                                <div class="service-quote"><img
                                        src="/static/media/icon_landingpage_versiterbaik.c4f90a41.svg">Mencapai versi
                                    terbaikmu
                                </div>
                                <div class="service-description">Satya Wacana Counseling akan selalu mendukung setiap
                                    langkahmu dalam mencapai versi terbaik dirimu.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex flex-column align-items-center">
                                <div class="service-quote"><img
                                        src="/static/media/icon_landingpage_percayadiri.8c532434.svg">Menjadi pribadi
                                    yang percaya diri
                                </div>
                                <div class="service-description">Setiap orang adalah spesial. Satya Wacana Counseling
                                    akan selalu siap mengingatkanmu bahwa kamu mampu, hingga kamu tidak ada alasan untuk
                                    meragukan dirimu sendiri.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer py-8" style="color: white; background: rgb(25, 43, 69);">
                    <div class="row justify-content-between p-6">
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-3">
                                    <img src="/static/media/uksw.d5473bc6.png" style="height: 92px">
                                </div>
                                <div class="col-8">
                                    <div>Jl. Diponegoro 52-60 Salatiga-Indonesia 50711 +62 813 9178 2878</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-1 my-8">
                            <div class="row">
                                <div class="col-4 d-flex justify-content-center">
                                    <a href="https://www.facebook.com/ukswsalatiga1956?_rdc=1&amp;_rdr" target="_blank">
                                        <img src="/static/media/icon_landingpage_facebook.d5e7c814.svg" style="height: 42px;">
                                    </a>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <a href="https://twitter.com/uksw_salatiga" target="_blank">
                                        <img src="/static/media/icon_landingpage_twitter.2d4450fb.svg" style="height: 42px;">
                                    </a>
                                </div>
                                <div class="col-4 d-flex justify-content-center">`
                                    <a href="https://instagram.com/uksw_salatiga" target="_blank">
                                        <img src="/static/media/icon_landingpage_instagram.a12b5891.svg" style="height: 42px;">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="text-align: center;">Copyright 2019 © GMIT - UKSW</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@if (config('layout.page-loader.type') != '')
    @include('layout.partials._page-loader')
@endif

{{--@include('layout.base._layout')--}}

<script>var HOST_URL = "{{ route('quick-search') }}";</script>

{{-- Global Config (global config for global JS scripts) --}}
<script>
    var csrf_token = "{{csrf_token() ?? null}}";
    var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
</script>
@foreach(config('layout.resources.js') as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
@endforeach
<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
<script src="/js/owl.carousel.js" type="text/javascript"></script>
<script src="/js/src/config.js" type="text/javascript"></script>
<script src="/js/src/landing.js" type="text/javascript"></script>
<script src="{{ asset('js/pages/features/miscellaneous/toastr.js') }}" type="text/javascript"></script>
<script>

    function throttleCheck(){
        @php($throttle = (session()->get("throttle") ?? null))
        var throttle = "{{$throttle}}";
        throttle = moment(throttle);
        window.throttleInterval = setInterval(()=>{
            var now = moment();
            duration = moment.duration(throttle.diff(now));

            $('.error-throttle > .error-countdown').text(moment.utc(duration.as('milliseconds')).format('HH:mm:ss'))
            $('.error-throttle').hide()
            console.log(duration.minutes()>0, duration.seconds()>0)
            if(duration.minutes()>0 || duration.seconds()>0){
                $('.error-throttle').show()
                $('#button__submit_login').addClass('shadow')
                $('#button__submit_login').prop('disabled', true)

            }else{
                $('#button__submit_login').removeClass('shadow')
                $('#button__submit_login').prop('disabled', false)
                $('.error-throttle').hide()
            }
        }, 1000)
    }

    function stopThrottleCheck(){
        console.log('clearing interval')
        window.clearInterval(window.throttleInterval);
        $('#button__submit_login').removeClass('shadow')
        $('#button__submit_login').prop('disabled', false)
        $('.error-throttle').hide()
    }
    $(document).ready(function(){
        throttleCheck();
    })
</script>
</body>
</html>
