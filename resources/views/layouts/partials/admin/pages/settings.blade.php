@extends('layouts.app')

@section('title', 'settings')

@section('content')
    <div class="container">
        <div class="row align-items-center">
            <div class="col py-4">
                <h2 class="fw-bold">Settings</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Tabs navs -->
                <ul class="nav nav-tabs nav-fill mb-3" id="ex1" role="tablist">
                    <li class="nav-item fw-bold" role="presentation">
                        <a class="nav-link active" id="ex2-tab-1" data-mdb-toggle="tab" href="#ex2-tabs-1" role="tab"
                            aria-controls="ex2-tabs-1" aria-selected="true">General Settings</a>
                    </li>
                    <li class="nav-item fw-bold" role="presentation">
                        <a class="nav-link" id="ex2-tab-2" data-mdb-toggle="tab" href="#ex2-tabs-2" role="tab"
                            aria-controls="ex2-tabs-2" aria-selected="false">Logo & Favicon</a>
                    </li>
                    <li class="nav-item fw-bold" role="presentation">
                        <a class="nav-link" id="ex2-tab-3" data-mdb-toggle="tab" href="#ex2-tabs-3" role="tab"
                            aria-controls="ex2-tabs-3" aria-selected="false">Social Media</a>
                    </li>
                </ul>
                <!-- Tabs navs -->

                <!-- Tabs content -->
                <div class="tab-content" id="ex2-content">
                    <div class="tab-pane fade show active" id="ex2-tabs-1" role="tabpanel" aria-labelledby="ex2-tab-1">
                        <form action={{ route('author.settings.update') }} method="POST">
                            @csrf
                            <div class="row my-4">
                                <div class="col-md-16">
                                    <!-- 2 column grid layout with text inputs for the first and last names -->
                                    <div class="form-outline mb-3">
                                        <input type="text" id="form6Example1" class="form-control" name="blog_name"
                                            value="{{ $settings->blog_name }}" />
                                        <label class="form-label" for="form6Example1">Blog name</label>
                                    </div>

                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <input type="text" id="form6Example5" class="form-control" name="blog_email"
                                            value="{{ $settings->blog_email }}" />
                                        <label class="form-label" for="form6Example5">Blog Email</label>
                                    </div>

                                    <!-- Message input -->
                                    <div class="form-outline mb-4">
                                        <textarea class="form-control" id="form6Example7" name="blog_description" rows="4">{{ "$settings->blog_description" }}</textarea>
                                        <label class="form-label" for="form6Example7">Blog Description</label>
                                    </div>

                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary btn-block">Save Changes<i
                                            class="fa fa-right-to-bracket"></i></button>
                                    @include('layouts.partials.frontend.auth.copy')
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="ex2-tabs-2" role="tabpanel" aria-labelledby="ex2-tab-2">
                        <div class="row my-4">
                            <div class="col-md-6">
                                <h3>Set Blog Logo</h3>
                                <div class="mb-2" style="max-width: 200px;">
                                    <img src="{{ asset($settings->blog_logo) }}" alt="{{ $settings->blog_logo }}" id="img-logo" class="img-thumbnail"
                                        id="logo-image-preview ">
                                </div>
                                @error('blog_logo')
                                    @php
                                        toastr()->error($message)
                                    @endphp
                                @enderror
                                <form action="{{ route('author.change-blog-logo') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-2">
                                        <input class="form-control form-control mb-3" name="blog_logo" id="blog_logo"
                                            type="file" />
                                        <button class="btn btn-primary">Change Logo</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ex2-tabs-3" role="tabpanel" aria-labelledby="ex2-tab-3">
                        @livewire('blog-social-media')
                    </div>
                </div>
                <!-- Tabs content -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#blog_logo').change(function() {
                readURL(this);
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#img-logo').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
@endpush