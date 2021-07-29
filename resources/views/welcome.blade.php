<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" value="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Movies App</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    </head>
    <body class="bg-gray-900 text-white">
        <div id="app">
            <movies-app></movies-app>

        </div>

    </body>
    <script src="{{mix('js/app.js')}}" defer></script>
</html>
