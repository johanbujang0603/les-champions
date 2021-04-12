<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots"content="index,follow">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')

    @if(config('app.env') == 'production')
    @include('web.partials.external_scripts')
    @endif
</head>
<body id="@yield('page_name', 'home')" class="@auth auth @else guest @endif @yield('classes')" @yield('body_attributes')>
    @include('web.layouts.header')
    @yield('content')
    @include('web.layouts.footer')
    @yield('hidden_elements')
    @include('web.partials.global_modals')
    <div class="modal-overlay"></div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    @yield('js')
</body>
</html>
