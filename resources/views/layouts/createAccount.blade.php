<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Création de mon compte sur {{ config('app.name') }}</title>
        <meta name="robots" content="noindex, nofollow" />
        <link rel="icon" href="{{ asset('favicon/favicon.ico') }}">
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
        <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
    </head>

    <body id="backEndUser">

        <div class="mb-5" style="padding:10px; background: linear-gradient(180deg, var(--main-color) 0%, var(--third-color) 100%);">
            <a href="{{ route('mf.index') }}">
                <img src="{{ asset('img/deco/logo.png') }}" width="150">
            </a>
        </div>

        <div class="container">

            @yield('content')

        </div>

    {{-- @include('footer.footer');   --}}

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}

    </body>
</html>
