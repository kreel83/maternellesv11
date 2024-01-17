<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{ $titre }}</title>
        <meta name="robots" content="noindex, nofollow" />
        <link rel="icon" href="{{ asset('favicon/favicon.ico') }}">
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    </head>

    <body id="backEndUser">

        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="background: linear-gradient(180deg, var(--main-color) 0%, var(--third-color) 100%);">
            <div class="container-fluid">
                <a href="{{ route('vitrine.index') }}" class="brand-logo d-none d-lg-block">
                    <img src="{{ asset('img/deco/logo.png') }}" alt="" width="130">
                </a>
            </div>
        </nav>

        <div style="margin-top: 80px"></div>

        <div class="container">

            {{-- <div class="d-flex justify-content-center mt-1 mb-3">
            
                <div>
                    <a href="{{route('vitrine.index')}}" class="brand-logo">
                        <img src="{{asset('img/deco/logo-couleur.png')}}" alt="" width="300">
                    </a>
                </div>
            
            </div>     --}}
            
            @yield('content')

        </div>

    {{-- @include('footer.footer');   --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    </body>
</html>
