{{-- <!DOCTYPE html>
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
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- إضافة Bootstrap عبر CDN -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">Laravel Blog</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="{{ route('welcome') }}">Home</a>
            <a class="p-2 text-dark" href="{{ route('home.contact') }}">Contact</a>
            <a class="p-2 text-dark" href="{{ route('posts.index') }}">Blog Posts</a>
            <a class="p-2 text-dark" href="{{ route('posts.create') }}">Add</a>
           
            @guest
            <a class="p-2 text-dark" href="{{ route('register') }}">Register</a>
            <a class="p-2 text-dark" href="{{ route('login') }}">login with another username</a>
                @if (Route::has('register'))
                    <a class="p-2 text-dark" href="{{ route('register') }}">Register</a>
                @endif
                <a class="p-2 text-dark" href="{{ route('login') }}">Login</a>
            @else
                <a class="p-2 text-dark" href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    >Logout ({{Auth::user()->name}})</a>

                <form id="logout-form" action={{ route('logout') }} method="POST"
                    style="display: none;">
                    @csrf
                </form>
            @endguest
        </nav>
    </div>
</head>
<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            @yield('content') <!-- تعديل هنا لاستخدام  بدلاً من $slot -->
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>

