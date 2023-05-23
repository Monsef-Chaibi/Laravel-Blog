@extends('layouts.app')

@section('title', 'Welcome to Blog')

@section('content')
    <div class="row">
        <div class="col-lg-8 mb-5 mb-lg-0">
            @if (latest_home_posts())
                @foreach (latest_home_posts() as $latestPosts)
                    <article class="row mb-5 article">
                        <div class="post-info">
                            <span class="text-uppercase">
                                {{ readDuration($latestPosts->post_title, $latestPosts->post_content) }}
                                @choice('min|mins', readDuration($latestPosts->post_title, $latestPosts->post_content)) read
                            </span>
                        </div>
                        <div class="col-12">
                            <div class="post-slider">
                                <img loading="lazy" src="{!! asset('storage/uploads/posts/' . $latestPosts->featured_image) !!}" class="img-fluid" alt="post-thumb">
                                <img loading="lazy" src="{!! asset('storage/uploads/posts/' . $latestPosts->featured_image) !!}" class="img-fluid" alt="post-thumb">
                                <img loading="lazy" src="{!! asset('storage/uploads/posts/' . $latestPosts->featured_image) !!}" class="img-fluid" alt="post-thumb">
                            </div>
                        </div>
                        <div class="col-12 mx-auto">
                            <h3>
                                <a class="post-title" href="{{ route('read_post', $latestPosts->post_slug) }}">
                                    {{ $latestPosts->post_title }}
                                </a>
                            </h3>
                            <ul class="list-inline post-meta mb-4">
                                <li class="list-inline-item">
                                    <i class="ti-user mr-2"></i>
                                    <a href="">
                                        {{ $latestPosts->author->where('id', $latestPosts->author_id)->pluck('username')->first() }}</a>
                                </li>
                                <li class="list-inline-item">Date : {{ date_formatter($latestPosts->created_at) }}
                                </li>
                                <li class="list-inline-item">
                                    Categories : <a href="{{ route('category_posts', $latestPosts->subcategory->slug) }}"
                                        class="ml-1">{{ $latestPosts->subcategory->parentCategory->category_name }}
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    Tags :
                                    <a href="#!" class="ml-1">{{ Str::ucfirst($latestPosts->post_tags) }}</a>
                                </li>
                            </ul>
                            <p>{!! Str::ucfirst(words($latestPosts->post_content, 35)) !!}</p>
                            <a href="{{ route('read_post', $latestPosts->post_slug) }}"
                                class="btn btn-outline-primary">Continue
                                Reading</a>
                        </div>
                    </article>
                @endforeach
            @endif
        </div>
        @include('layouts.partials.frontend.pages.partials.sidebar')
    </div>
@endsection
