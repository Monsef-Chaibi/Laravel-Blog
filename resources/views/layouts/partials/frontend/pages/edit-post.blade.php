@extends('layouts.app')

@section('title', 'Edit post')

@section('content')
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="multiple-border">Edit Post</h1>
            </div>
            <div class="row">
                <form action="{{ route('author.posts.update-post', ['post_id'=>Request('post_id')]) }}" method="POST" id="EditPostForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card border border-dark-subtle">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <label class="form-label">Post Title</label>
                                        <input type="text" class="form-control" name="post_title"
                                            placeholder="Enter post name..." value="{{ $post->post_title }}" />
                                        @error('post_title')
                                            <span class="text-danger fw-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Post Slug</label>
                                        <input type="text" class="form-control" name="post_slug"
                                            placeholder="Enter post slug..." value="{{ $post->post_slug }}" />
                                        @error('post_slug')
                                            <span class="text-danger fw-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Post Content</label>
                                        <textarea name="post_content" class="ckeditor form-control" id="post_content" placeholder="Content..." rows="6">{{ $post->post_content }}"</textarea>
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
                                                <option class="py-2" value="{{ $subcategory->id }}" {{ $post->category_id == $subcategory->id ? "selected" : "" }}>
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
                                        <img src="/storage/uploads/posts/thumbnails/resized_{{ $post->featured_image }}" alt="Preview Image" style="width: 100%;" height="200px"
                                            class="img-thumbnail" id="image_previewer" />
                                        <i class="fas fa-solid fa-upload fa-xl"></i>
                                    </div>
                                    <button type="submit" class="btn btn-info">Update Post</button>
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
