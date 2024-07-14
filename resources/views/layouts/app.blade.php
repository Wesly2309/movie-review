<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie Review</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-700 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div>
                <a href="{{ url('/') }}" class="text-white text-lg font-bold">MOVIE REVIEW</a>
            </div>
            <div>
                @guest
                    <a href="{{ route('login') }}" class="text-white text-lg mx-2">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-white text-lg mx-2">Register</a>
                    @endif
                @else
                    <span class="text-white text-lg mx-2">{{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" class="text-white text-lg mx-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
    </nav>
    <div class="container mx-auto mt-4">
        @yield('content')
    </div>
</body>
</html>
