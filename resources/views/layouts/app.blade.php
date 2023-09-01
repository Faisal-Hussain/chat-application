<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js').'?v='.time() }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css').'?v='.time() }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles/style.css').'?v='.time() }}">
    <link rel="stylesheet" href="{{ asset('css/styles/responsive.css').'?v='.time() }}">
    @stack('style')
</head>
<body class="ltr @if(Illuminate\Support\Facades\Route::currentRouteName('chat')) chat-body @else no-chat-body @endif">
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
    <script type="application/javascript" src="{{ asset('js/Btn_active.js').'?v='.time() }}"> </script>
    <script type="application/javascript" src="{{ asset('js/sidenavUsers.js').'?v='.time() }}"></script>
    <script type="application/javascript" src="{{ asset('js/sidenavResults.js').'?v='.time() }}"></script>
    <script type="application/javascript">
        @auth
            window.id = '{{  auth()->user()->id }}';
        @endauth
            window.routeName = '{{  Illuminate\Support\Facades\Route::currentRouteName()}}';
            window.site = '{{  env('APP_URL') }}';
    </script>
    @stack('js')
</body>
</html>
