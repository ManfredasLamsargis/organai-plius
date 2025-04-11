<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Organs+</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        @if(session()->has('message'))
            <div class="success-message">
                {{ session('message') }}
            </div>
        @endif
        {{ $slot }}
    </body>
</html>