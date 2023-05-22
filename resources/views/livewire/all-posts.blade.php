<div class="container">
    <div class="row align-items-center">
        <div class="col-6">
            <h1 class="multiple-border">All Posts</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="d-flex align-items-center gap-1 mb-1">
                <label class="form-label d-inline-block m-0 p-0">Search</label>
                <i class="fas fa-solid fa-search"></i>
            </div>
            <input type="text" class="form-control" placeholder="Keyword..." wire:model="search" />
        </div>
        <div class="col-md-2 mb-3">
            <div class="d-flex align-items-center gap-1 mb-1">
                <div class="form-label d-inline-block fw-bold m-0 p-0">Category</div>
                <i class="fas fa-list-alt"></i>
            </div>
            <select class="form-select" wire:model="category">
                <option value="">-- No selected --</option>
                @foreach ($subcategories as $subcategory)
                    <option class="py-2" value="{{ $subcategory->id }}">
                        {{ $subcategory->subcategory_name }}
                    </option>
                @endforeach
            </select>
        </div>
        @if (auth()->user()->role == 'admin')
            <div class="col-md-2 mb-3">
                <div class="form-label d-inline-block me-1 fw-bold">Author</div>
                <i class="fas fa-regular fa-pen-nib"></i>
                <select class="form-select" wire:model="author">
                    <option value="">-- No selected --</option>
                    @foreach ($authors as $author)
                        <option class="py-2" value="{{ $author->id }}">
                            {{ $author->username }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="col-md-2 mb-3">
            <div class="form-label d-inline-block me-1 fw-bold">SortBy</div>
            <i class="fas fa-duotone fa-sort"></i>
            <select class="form-select" wire:model="orderBy">
                <option value="asc">ASC</option>
                <option value="desc">DESC</option>
            </select>
        </div>
    </div>
    <div class="row">
        @forelse ($posts as $post)
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card border border-dark-subtle">
                    <img src="/storage/uploads/posts/thumbnails/resized_{{ $post->featured_image }}"
                        class="card-img-top" alt="{{ $post->featured_image }}">
                    <div class="card-body">
                        <h5 class="card-title fw-600 mb-2">{{ $post->post_title }}</h5>
                        <p class="card-text fw-400 mb-2">{{ strip_tags(html_entity_decode($post->post_content)) }}</p>
                        <a href="{{ route('author.posts.edit-post', ['post_id' => $post->id]) }}"
                            class="btn btn-info">Edit</a>
                        <form action="{{ route('author.posts.delete-post', ['post_id' => $post->id]) }}"
                            class="d-inline-block" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"  onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-danger">
                <p class="p-0 m-0">No Post(s) Found.</p>
            </div>
        @endforelse
    </div>
    <div class="d-block mt-2">
        {{ $posts->links('livewire::bootstrap') }}
    </div>
</div>
