@extends('layouts.auth-master')

@section('title', 'login')

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col-xl-5 col-md-8 m-5">
            <form class="bg-white rounded-5 shadow-5-strong p-5" method="POST" action="{{ route('login.perform') }}">
                @csrf
                <div class="form-group mb-4">
                    <p class="mb-3 fw-bold text-center text-warning" style="letter-spacing: 3px">WELCOME BACK</p>
                    <div class="col-md-12 text-center mb-2" id="avatar">
                        @include('layouts.partials.frontend.auth.avatar')
                    </div>
                    <p class="fw-bold fs-4 text-center">Sign In to Your Account</p>
                </div>
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                @if (Session::has('warning'))
                    <div class="alert alert-warning" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif

                @include('layouts.partials.frontend.auth.messages')

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="text" id="form1Example1" class="form-control" name="username"
                        @if (Cookie::has('username')) value="{{ Cookie::get('username') }}" @endif required autofocus />
                    <label class="form-label" for="form1Example1">Email or Username</label>
                    @if ($errors->has('username'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="form1Example2" class="form-control" name="password"
                        @if (Cookie::has('password')) value="{{ Cookie::get('password') }}" @endif required />
                    <label class="form-label" for="form1Example2">Password</label>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                @if (Cookie::has('username')) checked @else {{ '' }} @endif name="remember"
                                id="remember" />
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                    </div>

                    <div class="col text-center">
                        <!-- Simple link -->
                        <a href="{{ route('forget.password.get') }}">Forgot password?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block">Sign in <i
                        class="fa-right-to-bracket"></i></button>
                @include('layouts.partials.frontend.auth.copy')
            </form>
        </div>
    </div>
@endsection
