<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SuministrosElectricos S.A')</title>
    @vite(['resources/js/app.js'])
    @vite(['resources/css/app.css'])
</head>
<body>
    <header>
        <!-- Aquí puedes incluir tu navegación -->
        @include('layouts.navbar')
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Pie de página -->
        @include('layouts.footer')
    </footer>
</body>
</html>
