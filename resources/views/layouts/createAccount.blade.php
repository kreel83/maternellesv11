<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Création de mon compte sur {{ env('APP_NAME') }}</title>
        <meta name="robots" content="noindex, nofollow" />

        @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    </head>

    <body id="backEndUser">

    <div class="container">

        <div class="d-flex justify-content-center mt-1 mb-3">
        
            <div>
                <a href="{{route('vitrine.index')}}" class="brand-logo">
                    <img src="{{asset('img/deco/logo.png')}}" alt="" width="250">
                </a>
            </div>
        
        </div>    
          
        @yield('content')

    </div>

    {{-- @include('footer.footer');   --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    </body>
</html>
