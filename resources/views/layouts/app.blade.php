<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>
        @if (url()->current() == 'http://localhost:8000')
            Blog | {{ $pageTitle }}
        @else
            Blog | @yield('title')
        @endif
    </title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <!-- Meta Tags -->
    @yield('meta_tags')

    <!-- plugins -->
    <link rel="preload" href="https://fonts.gstatic.com/s/opensans/v18/mem8YaGs126MiZpBA-UFWJ0bbck.woff2"
        style="font-display: optional;">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Montserrat:600%7cOpen&#43;Sans&amp;display=swap" media="screen">

    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/slick/slick.css') }}">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/ui-kit/css/mdb.min.css') }}">
    @stack('stylesheets')
    <!--Favicon-->
    <link rel="shortcut icon" href="{{ asset(blogInfo()->blog_logo) }}" type="image/x-icon">
    <link rel="icon" href="{{ asset(blogInfo()->blog_logo) }}" type="image/x-icon">
</head>

<body>
    <!-- navigation -->
    @include('layouts.partials.frontend.pages.partials.header')
    <!-- /navigation -->

    <section class="section">
        <div class="container">
            @yield('content')
        </div>
    </section>
    @include('layouts.partials.frontend.pages.partials.footer')


    <!-- JS Plugins -->
    <script src="{{ asset('assets/frontend/plugins/jQuery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/plugins/bootstrap/bootstrap.min.js') }}"></script>
    @stack('scripts')
    <script src="{{ asset('assets/frontend/plugins/slick/slick.min.js') }}"></script>
    <!-- Main Script -->
    <script src="{{ asset('assets/frontend/js/script.js') }}"></script>
    <script src="{{ asset('assets/ui-kit/js/mdb.min.js') }}"></script>
</body>

</html>
