<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        
        <v-sidebar
            :auth="{{ Auth::user() }}"
            :rolename="{{ json_encode(Auth::user()->role()->name) }}"
        ></v-sidebar>
        @if (Route::has('login'))
            <v-header
                dasboard-url="{{ url('/dashboard') }}"
                login-url="{{ route('login') }}"
                logout-url="{{ route('logout') }}"
                register-url="{{ route('register') }}"
                is-logged-in="{{ Auth::user() ? true : false }}"
                csrf
                has-register-route="{{ Route::has('register') && !Auth::user() ? true : false }}"
            >
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </v-header>
        @endif
        @yield('content')
        @yield('modals');
    </div>
</body>
<script scr="{{ asset('js/app.js') }}"></script>
@yield('scripts');
</html>
