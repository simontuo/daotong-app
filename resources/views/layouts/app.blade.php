<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="http://www.logomr.com/logomrdata/2017/11/07/59d7ad03-f3d6-41e5-970f-4c7bb495cab3.png" type="image/x-icon" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ Auth::check() ? 'Bearer '.Auth::user()->api_token : 'Bearer ' }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<!-- <body class="mdui-theme-primary-indigo mdui-theme-accent-pink mdui-appbar-with-toolbar" style="background: #f5f7f9;"> -->
<body class="mdui-theme-primary-indigo mdui-theme-accent-pink mdui-appbar-with-toolbar" style="background: #eef5f9;">
    <div id="app">
        @include('layouts.navbar')

        <div class="mdui-m-t-2 mdui-container">
            @yield('content')
            @yield('rightBar')
        </div>

        <back-top></back-top>

        @include('layouts.footer')
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <!-- sweetalert -->
    @include('sweet::alert')
</body>
</html>
