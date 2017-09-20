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
    <script src="https://cdn.bootcss.com/highlight.js/9.12.0/highlight.min.js"></script>
</head>
<body class="mdui-theme-primary-indigo mdui-theme-accent-pink mdui-appbar-with-toolbar">
    <div id="app">
        @include('layouts.navbar')

        <div class="mdui-m-t-2">
            @yield('content')
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <!-- sweetalert -->
    @include('sweet::alert')
    <!-- <script>
        @if (session('message'))
            // swal({
            //     title: "{{ session('message')['message']['title'] }}",
            //     text: "{{ session('message')['message']['text'] }}",
            //     type: "{{ session('message')['status'] }}",
            //     timer: "{{ config('sweetalert.timer', 'Laravel') }}"
            // });
            swal("Oops!", "Something went wrong!", "error")
        @endif
    </script> -->
</body>
</html>
