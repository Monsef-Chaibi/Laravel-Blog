<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @if (url()->current() == 'http://localhost:8000')
            {{ env('APP_NAME') }} | {{ $pageTitle }}
        @else
            Blog | @yield('title')
        @endif
    </title>
    <!-- Swal Alert -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <!-- Website logo -->
    <link rel="blog_icon" sizes="180x180" href="{{ asset(blogInfo()->blog_logo) }}">
    <link rel="shortcut icon" href="{{ asset(blogInfo()->blog_logo) }}">
    <link rel="manifest" href="{{ asset(blogInfo()->blog_logo) }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{!! URL::to('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') !!}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/ui-kit/css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('jquery-ui-1.13.2/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('jquery-ui-1.13.2/jquery-ui.structure.min.css') }}">
    <link rel="stylesheet" href="{{ asset('jquery-ui-1.13.2/jquery-ui.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('amsify/amsify.suggestags.css') }}">
    @livewireStyles
</head>

<body>
    <!-- Preloader -->
    @include('layouts.partials.frontend.preloader')
    <!--Main Navigation-->
    <header>
        <!-- Navbar -->
        @include('layouts.partials.frontend.navbar')
        <!-- Navbar -->
        <!-- SideBar -->
        @include('layouts.partials.frontend.sidebar')
        <!-- SideBar -->
    </header>
    {{-- @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif --}}

    <!--Main Navigation-->
    <div class="container">
        @yield('content')
    </div>

    @livewireScripts
    <!-- jQuery -->
    <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('jquery-ui-1.13.2/jquery-ui.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/admin/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/ui-kit/js/mdb.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

    <script src="{{ asset('amsify/jquery.amsify.suggestags.js') }}"></script>
    <script>
        $('input[name="post_tags"]').amsifySuggestags();
    </script>
    @stack('scripts')
</body>

</html>
