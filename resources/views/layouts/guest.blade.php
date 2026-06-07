<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="background: #FAF3E8; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Figtree', sans-serif;">

        <div style="width: 100%; max-width: 480px; padding: 16px;">
            <div style="background: #FFFDF7; border-radius: 20px; padding: 40px; box-shadow: 0 4px 30px rgba(44,24,16,0.10); border: 1px solid #E8D5C0;">
                {{ $slot }}
            </div>
        </div>

    </body>
</html>