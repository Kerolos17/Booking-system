<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Event Booking')</title>
    <script src="https://unpkg.com/html5-qrcode"></script>
    @vite('resources/css/app.css')
    <!-- Removed duplicate CSS inclusion -->
</head>
<body>

    <div class="container mx-auto py-8 my-auto h:full">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
