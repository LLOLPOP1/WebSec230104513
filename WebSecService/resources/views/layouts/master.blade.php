<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WebSec - @yield('title')</title>

    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    {{-- Custom Styles --}}
    <style>
        .navbar {
            background-color: #343a40;
        }
        .navbar .nav-link {
            color: white !important;
        }
        .navbar .nav-link:hover {
            color: #f8f9fa !important;
            transform: scale(1.05);
            transition: 0.3s;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 15px 0;
            text-align: center;
            margin-top: 30px;
        }
    </style>

    {{-- Bootstrap JS --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</head>

<body>

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Main Content --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer>
        <p>&copy; 2025 WebSec. All rights reserved.</p>
    </footer>

</body>
</html>
