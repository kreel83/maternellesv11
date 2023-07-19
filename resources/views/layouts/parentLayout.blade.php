<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Ma maternelle</title>

        @vite(['resources/scss/app.scss', 'resources/js/app.js'])

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

    <body>

    <div class="container">
        @yield('content')
    </div>

    @include('footer.footer');

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</body>
</html>
