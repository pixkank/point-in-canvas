<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @vite(['resources/css/app.css','resources/js/app.js'])
        @livewireStyles
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body class="bg-gray-400">
        {{ $slot }}
        @livewireScripts
    </body>
</html>
