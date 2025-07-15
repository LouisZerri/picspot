<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PicSpot')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    @if (session('success') || session('status') || $errors->any())
        <div id="toast-data" data-success="{{ session('success') }}" data-status="{{ session('status') }}"
            data-errors='@json($errors->all())'>
        </div>
    @endif

    <div id="toast-container"></div>

    <main class="bg-gradient-to-br from-slate-50 via-white to-purple-50 min-h-screen m-0 p-0" id="app">
        @yield('content')
    </main>

    <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}',
            user: @json(Auth::user()),
            isAuthenticated: @json(Auth::check())
        };
    </script>
</body>

</html>
