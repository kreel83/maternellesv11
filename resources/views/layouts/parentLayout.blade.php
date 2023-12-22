<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{ $titre }}</title>
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])

        <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

        <!-- Fonts -->
        <!--<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">-->

        <!--
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                width: 100%;
                height: 100vh;
            }
            .container {
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }
        </style>
        -->
    </head>

    <body id="backEndUser">

    <div class="container m-0 p-0">



        @yield('content')

    </div>

    {{-- @include('footer.footer');   --}}

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script> --}}
    {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  --}}

</body>
</html>
