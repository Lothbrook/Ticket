<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('build/assets/app-c5a22595.css') }}">
    <script src="{{ asset('build/assets/app-0d91dc04.js') }}" defer></script>

    <!-- Custom Styles for Background Image -->
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image: url('{{ asset('background.jpg') }}'); /* Remplacez par votre URL d'image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="login-container">
        <div class="login-box">
            <!--<div class="mb-4">-->
            <!--    <a href="/">-->
            <!--        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />-->
            <!--    </a>-->
            <!--</div>-->

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
