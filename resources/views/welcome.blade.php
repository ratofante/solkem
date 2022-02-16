<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Solkem </title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ url('css/admin.css') }}">
    </head>
    <body class="antialiased homeBody">
        <div class="homeContainer">
            <div class="logoDiv">
                <img src="{{ url('images/logo-solkem.png') }}" alt="Solkem">
            </div>
            @if (Route::has('login'))
                <div class="ingresarButton">
                    @auth
                        <a href="{{ url('/home') }}" class="">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="">Ingresar</a>
                    @endauth
                </div>
            @endif
        </div>

    </body>
</html>
