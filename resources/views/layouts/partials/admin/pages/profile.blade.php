@extends('layouts.admin')

@section('title', 'profile')

@section('content')
    <div class="container rounded bg-white mt-4 mb-5 profile">
        @if (isset($errors) && count($errors) > 0)
            <div class="alert alert-danger" role="alert">
                <ul class="m-0 px-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-3 border-right">
                    <label for="avatar" class="avatar">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <img class="rounded-circle mt-5" width="150px" src="{{ asset(Auth::user()->picture) }}" />
                            <span class="font-weight-bold"> <span>{{ Auth::user()->username }}</span> | <span
                                    style="text-transform: capitalize"> {{ Auth::user()->role }} </span>
                                <input type="file" name="picture" id="avatar" hidden>
                            </span>
                            <span class="text-black-50">{{ Auth::user()->email }}</span>
                        </div>
                    </label>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Name</label><input type="text" name="name"
                                    class="form-control" placeholder="first name" value="{{ Auth::user()->name }}"></div>
                            <div class="col-md-6"><label class="labels">Username</label><input type="text"
                                    class="form-control" name="username" value="{{ Auth::user()->username }}" placeholder="username"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">E-Mail Address</label><input type="email"
                                    class="form-control" placeholder="email address" value="{{ Auth::user()->email }}"
                                    name="email" disabled></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"><label class="labels">Country</label><input type="text"
                                    class="form-control" placeholder="country" value="{{ Auth::user()->country }}" name="country"></div>
                            <div class="col-md-6"><label class="labels">State/Region</label><input type="text"
                                    class="form-control" name="state" value="{{ Auth::user()->state }}" placeholder="state"></div>
                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save
                                Profile</button></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Additional Details</h4>
                        </div>
                        <div class="col-md-12 bio mt-2">
                            <label class="labels">Biography</label>
                            <textarea class="form-control" placeholder="Biography..." name="bio" rows="4">{{ Auth::user()->bio }}</textarea>
                        </div>
                        <div class="col-md-12 bio mt-2">
                            <label class="labels">Current password</label>
                            <input class="form-control" type="password" placeholder="current password..." name="current_password" />
                        </div>
                        <div class="col-md-12 bio mt-2">
                            <label class="labels">New Password</label>
                            <input class="form-control" type="password" placeholder="new password..." name="new_password" />
                        </div>
                        <div class="col-md-12 bio mt-2">
                            <label class="labels">Confirm New Password</label>
                            <input class="form-control" type="password" placeholder="retype new password..." name="confirm_new_password" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
