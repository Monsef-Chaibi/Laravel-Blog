@extends('layouts.auth-master')

@section('title', 'Reset Password')

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col-xl-5 col-md-8 m-5">
            <form class="bg-white rounded-5 shadow-5-strong p-5" action="{{ route('forget.password.post') }}" method="POST">
                @csrf
                <div class="form-group mb-4">
                    <p class="mb-3 fw-bold text-center fs-4 text-warning" style="letter-spacing: 3px">Reset Password</p>
                </div>
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                @if (isset($errors) && count($errors) > 0)
                    <div class="alert alert-danger" role="alert">
                        <ul class="m-0 px-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="text" id="form1Example1" class="form-control" name="email" required autofocus />
                    <label class="form-label" for="form1Example1">E-Mail Address</label>
                </div>


                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block"> Send Password Reset Link </button>
                @include('layouts.partials.frontend.auth.copy')
            </form>
        </div>
    </div>
@endsection
