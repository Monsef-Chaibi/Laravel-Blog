@extends('layouts.app')

@section('title', isset($pageTitle) ? $pageTitle : 'Welcome to Blog')

@section('content')
    <section class="section-sm">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumbs mb-4"> <a href="{{ route('home') }}">Home</a>
                        <span class="mx-1">/</span> <a href="#!">Articles</a>
                        <span class="mx-1">/</span> <a href="">{{ Str::ucfirst($category->subcategory_name) }}</a>
                    </div>
                    <h1 class="mb-4 border-bottom border-primary d-inline-block">
                        {{ Str::ucfirst($category->subcategory_name) }}</h1>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        @forelse ($posts as $post)
                            <div class="col-lg-6 col-sm-6 mb-4">
                                <article class="mb-5 article">
                                    <div class="post-info">
                                        <span class="text-uppercase">
                                            {{ readDuration($post->post_title, $post->post_content) }}
                                            @choice('min|mins', readDuration($post->post_title, $post->post_content)) read
                                        </span>
                                    </div>
                                    <div class="post-slider slider-sm">
                                        <img loading="lazy"
                                            src="{{ asset('/storage/uploads/posts/thumbnails/resized_' . $post->featured_image) }}"
                                            class="img-fluid" alt="post-thumb" />
                                    </div>
                                    <h3 class="h5">
                                        <a class="post-title" href="{{ route('read_post', $post->post_slug) }}">
                                            {{ $post->post_title }}
                                        </a>
                                    </h3>
                                    <ul class="list-inline post-meta mb-2">
                                        <li class="list-inline-item">
                                            <i class="ti-user mr-2"></i>
                                            <a
                                                href="author.html">{{ $post->author->where('id', $post->author_id)->pluck('username')->first() }}</a>
                                        </li>
                                        <li class="list-inline-item">Date : {{ date_formatter($post->created_at) }}</li>
                                        <li class="list-inline-item">Categories :
                                            <a href="{{ route('category_posts', $post->subcategory->slug) }}"
                                                class="ml-1">{{ $post->subcategory->parentCategory->category_name }}</a>
                                        </li>
                                        <li class="list-inline-item">Tags :
                                            <a href="#!" class="ml-1">{{ Str::ucfirst($post->post_tags) }} </a>
                                        </li>
                                    </ul>
                                    <p>
                                        {!! Str::ucfirst(words($post->post_content, 25)) !!}
                                    </p>
                                    <a href="{{ route('read_post', $post->post_slug) }}"
                                        class="btn btn-outline-primary">Continue Reading</a>
                                </article>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                <span class="fw-bold text-info">No post(s) found for this category!</span>
                            </div>
                        @endforelse
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    {{ $posts->appends(request()->input())->links('layouts.partials.frontend.pages.partials.custom_pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <aside class="col-lg-4">
                    <div class="widget-second">
                        <div class="widget-second-body">
                            <img loading="lazy" decoding="async" src="" alt="About Me"
                                class="w-100 author-thumb-sm d-block">
                            <h2 class="widget-title my-3">Hootan Safiyari</h2>
                            <p class="mb-3 pb-2">Hello, I’m Hootan Safiyari. A Content writter, Developer and Story teller.
                                Working as a Content writter at CoolTech Agency. Quam nihil …</p> <a href="about.html"
                                class="btn btn-sm btn-outline-primary">Know
                                More</a>
                        </div>
                    </div>
                    <!-- categories -->
                    <div class="widget">
                        <h5 class="widget-title"><span>Categories</span></h5>
                        @if (categories())
                            @foreach (categories() as $category)
                                <ul class="list-unstyled widget-list">
                                    <li>
                                        <a href="{{ route('category_posts', $category->slug) }}" class="d-flex">
                                            {{ Str::ucfirst($category->subcategory_name) }}
                                            <small class="ml-auto">({{ $category->posts->count() }})</small>
                                        </a>
                                    </li>
                                </ul>
                            @endforeach
                        @else
                            <ul class="list-unstyled widget-list">
                                <li>
                                    <a href="#!" class="d-flex">There No Categories..!</a>
                                </li>
                            </ul>
                        @endif
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
