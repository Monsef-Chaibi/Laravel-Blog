<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @if (url()->current() == 'http://localhost:8000')
            Projet_stage | {{ $pageTitle }}
        @else
            Projet_stage | @yield('title')
        @endif
    </title>
    <!-- Website logo -->
    <link rel="blog_icon" sizes="180x180" href="{{ asset(\App\Models\Setting::get()->first()->blog_logo) }}">
    <link rel="shortcut icon" href="{{ asset(\App\Models\Setting::get()->first()->blog_logo) }}">
    <link rel="manifest" href="{{ asset(\App\Models\Setting::get()->first()->blog_logo) }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{!! URL::to('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') !!}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/ui-kit/css/mdb.min.css', 'resources/ui-kit/js/mdb.min.js'])
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
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <!--Main Navigation-->
    <div class="container">
        @yield('content')
    </div>
    @livewireScripts
</body>

</html>

<!-- jQuery -->
<script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin/dist/js/adminlte.js') }}"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>
