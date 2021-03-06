<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ Auth::check() ? 'Bearer '.Auth::user()->api_token : 'Bearer ' }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body class="mdui-appbar-with-toolbar mdui-drawer-body-left mdui-theme-primary-indigo mdui-theme-accent-pink" style="background: #f0f2f5;">
    <div id="app">
        @include('layouts.admins.navbar')

        <div class="mdui-m-a-2">
            @yield('content')
        </div>

        <back-top></back-top>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <!-- sweetalert -->
    @include('sweet::alert')
</body>
</html>
