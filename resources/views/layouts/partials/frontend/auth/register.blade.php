@extends('layouts.app')

@section('title', 'register')

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col-xl-5 col-md-8 m-3">
            <form class="bg-white rounded-5 shadow-5-strong px-5 py-4" method="POST" action="{{ route('register.perform') }}"
                required autofocus>
                @csrf
                <div class="form-group mb-4">
                    <p class="m-3 mb-0 fw-bold text-center fs-3 text-warning" style="letter-spacing: 3px">Register</p>
                    <p class="fw-bold fs-4 text-center">Sign Up Free Account</p>
                </div>

                @include('layouts.partials.frontend.auth.messages')

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" id="form1Example1" class="form-control" name="email" value="{{ old('email') }}" />
                    <label class="form-label" for="form1Example1">Email address</label>
                </div>
                <!-- Username input -->
                <div class="form-outline mb-4">
                    <input type="text" id="form1Example1" class="form-control" name="username"
                        value="{{ old('username') }}" />
                    <label class="form-label" for="form1Example1">Username</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="form1Example2" class="form-control" name="password"
                        value="{{ old('password') }}" required />
                    <label class="form-label" for="form1Example2">Password</label>
                </div>
                <!-- Password confirmation input -->
                <div class="form-outline mb-4">
                    <input type="password" id="form1Example2" class="form-control" name="password_confirmation"
                        value="{{ old('password_confirmation') }}" required />
                    <label class="form-label" for="form1Example2">Password</label>
                </div>

                <!-- 1 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col text-center">
                        <!-- Simple link -->
                        <a href="{{ route('login') }}">Already Have Account?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                @include('layouts.partials.frontend.auth.copy')
            </form>
        </div>
    </div>
@endsection

@push('stylesheets')
    <style>
        .btn-primary {
            background: #3b71ca !important;
            color: #fff;
            border-color: #3b71ca !important;
            border-radius: none !important;
            box-shadow: 0 4px 9px -4px #3b71ca !important;
        }

        .btn {
            border-radius: 0.25rem !important;
        }

        .btn-primary:active,
        .btn-primary:hover,
        .btn-primary.focus,
        .btn-primary.active {
            background: #386bc0 !important;
            border-color: #386bc0 !important;
            border-radius: none !important;
            
        }
    </style>
@endpush
