@extends('layouts.app')

@section('title', 'Add new post')

@section('content')
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="multiple-border">Add new Post</h1>
            </div>
            <div class="row">
                <form action="{{ route('author.posts.create') }}" method="POST" id="addPostForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card border border-dark-subtle">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <label class="form-label">Post Title</label>
                                        <input type="text" class="form-control" name="post_title"
                                            placeholder="Enter post name..." />
                                        @error('post_title')
                                            <span class="text-danger fw-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Post Slug</label>
                                        <input type="text" class="form-control" name="post_slug"
                                            placeholder="Enter post slug..." />
                                        @error('post_slug')
                                            <span class="text-danger fw-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Post Content</label>
                                        <textarea name="post_content" class="ckeditor form-control" id="post_content" placeholder="Content..." rows="6"></textarea>
                                        @error('post_content')
                                            <span class="text-danger fw-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Post Category</label>
                                        <select class="form-select" name="post_category">
                                            <option value="">-- No selected --</option>
                                            @foreach ($subcategories as $subcategory)
                                                <option class="py-2" value="{{ $subcategory->id }}">
                                                    {{ $subcategory->subcategory_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('post_category')
                                            <span class="text-danger fw-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Featured Image</label>
                                        <input type="file" class="form-control" name="featured_image"
                                            id="featured_image" />
                                        @error('featured_image')
                                            <span class="text-danger fw-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="image_holder mb-3 me-0 p-0">
                                        <img src="" alt="Preview Image" style="width: 100%;" height="200px"
                                            class="img-thumbnail" id="image_previewer" />
                                        <i class="fas fa-solid fa-upload fa-xl"></i>
                                    </div>
                                    <button type="submit" class="btn btn-info">Save Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('post_content');
        $(document).ready(function() {
            $('#featured_image').change(function() {
                readURL(this);
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image_previewer').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
@endpush
