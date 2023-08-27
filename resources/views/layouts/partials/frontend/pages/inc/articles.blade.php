@extends('layouts.app')

@section('title', isset($pageTitle) ? $pageTitle : 'Welcome to Blog')

@section('meta_tags')
    <meta name="robots" content="index,follow" />
    <meta name="title" content="{{ blogInfo()->blog_name }}" />
    <meta name="description" content="{{ blogInfo()->blog_description }}" />
    <meta name="author" content="{{ blogInfo()->blog_name }}" />
    <link rel="canonical" href="{{ Request::root() }}" />
    <meta property="og:title" content="{{ blogInfo()->blog_name }}" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="{{ blogInfo()->blog_description }}" />
    <meta property="og:url" content="{{ Request::root() }}" />
    <meta property="og:image" content="{{ blogInfo()->blog_logo }}" />
    <meta name="twitter:domain" content="{{ Request::root() }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" property="og:title" itemprop="name" content="{{ blogInfo()->blog_name }}" />
    <meta name="twitter:description" property="og:description" itemprop="description"
        content="{{ blogInfo()->blog_description }}" />
    <meta name="twitter:image" content="{{ blogInfo()->blog_logo }}" />
@endsection

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
                                        class="ml-1">
                                        {{ $latestPosts->subcategory->subcategory_name }}
                                    </a>
                                </li>
                                @if ($latestPosts->post_tags)
                                    <li class="list-inline-item">
                                        Tags <i class="ti-tag"></i> :
                                        @php
                                            $postTagsString = $latestPosts->post_tags;
                                            $tagsArray = explode(',', $postTagsString);
                                        @endphp
                                        @foreach ($tagsArray as $tag)
                                            <a href="{{ route('tag_posts', $tag) }}">#{{ $tag }}</a>
                                        @endforeach
                                    </li>
                                @endif
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
