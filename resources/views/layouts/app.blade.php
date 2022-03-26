<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="{{ env('APP_URL') }}"/>

    <title> @yield('title', config('app.name', 'Laravel') ) </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('img/logo.jpg') }}" type="image/x-icon">

    @stack('styles')
</head>
<body class="bg-gray-50">
    <main class="container mx-auto p-5">
        @if(session()->has('type') && session()->has('message'))
            <div
                id="alerta"
                data-type="{{ session()->get('type') }}"
                data-message="{{ session()->get('message') }}"
            ></div>
        @endif
        @yield('content')
    </main>
</body>
</html>
