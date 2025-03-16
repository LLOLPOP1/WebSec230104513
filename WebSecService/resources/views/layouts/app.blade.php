<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
<body>
    <header>
        @include('layouts.navbar')
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2025 Your Website</p>
    </footer>
</body>
</html>