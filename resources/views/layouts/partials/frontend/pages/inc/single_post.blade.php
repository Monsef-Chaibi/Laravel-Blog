@extends('layouts.app')

@section('title', isset($pageTitle) ? $pageTitle : 'Welcome to Blog')

@section('meta_tags')
    <meta name="robots" content="index,follow, max-snippet:-1, max-large-preview:large, max-video-preview:-1" />
    <meta name="title" content="{{ Str::ucfirst($post->post_title) }}" />
    <meta name="description" content="{{ Str::ucfirst(words($post->post_content, 120)) }}" />
    <meta name="author" content="{{ Str::ucfirst($post->author->username) }}" />
    <link rel="canonical" href="{{ route('read_post', $post->post_slug) }}" />
    <meta property="og:title" content="{{ Str::ucfirst($post->post_title) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:description" content="{{ Str::ucfirst(words($post->post_content, 120)) }}" />
    <meta property="og:url" content="{{ route('read_post', $post->post_slug) }}" />
    <meta property="og:image" content="{{ asset('/storage/uploads/posts/thumbnails/resized_' . $post->featured_image) }}" />
    <meta name="twitter:domain" content="{{ Request::getHost() }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ Str::ucfirst($post->post_title) }}" />
    <meta name="twitter:description" content="{{ Str::ucfirst(words($post->post_content, 120)) }}" />
    <meta name="twitter:image"
        content="{{ asset('/storage/uploads/posts/thumbnails/resized_' . $post->featured_image) }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <section class="section">
        <div class="container">
            <article class="row mb-4">
                <div class="col-lg-10 mx-auto">
                    <h1 class="h2 mb-3">
                        {{ $post->post_title }}
                    </h1>
                    <ul class="list-inline post-meta mb-3">
                        <li class="list-inline-item">
                            <i class="ti-user mr-2"></i><a
                                href="author.html">{{ $post->author->where('id', $post->author_id)->pluck('username')->first() }}</a>
                        </li>
                        <li class="list-inline-item"><i class="ti-calendar"></i> : {{ date_formatter($post->created_at) }}
                        </li>
                        <li class="list-inline-item">
                            Categories : <a href="{{ route('category_posts', $post->subcategory->slug) }}"
                                class="ml-1">{{ $post->subcategory->subcategory_name }} </a>
                        </li>
                        @if ($post->post_tags)
                            <li class="list-inline-item">
                                Tags <i class="ti-tag"></i> :
                                @php
                                    $postTagsString = $post->post_tags;
                                    $tagsArray = explode(',', $postTagsString);
                                @endphp
                                @foreach ($tagsArray as $tag)
                                    <a href="{{ route('tag_posts', $tag) }}">#{{ $tag }}</a>
                                @endforeach
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="col-lg-10 mx-auto mb-4 bookmark-icon">
                    <form id="myForm" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $post->id }}" id="postBookmark" />
                        <button class="bookmark mx-auto" type="submit">
                            <div class="icon">
                                <svg viewBox="0 0 36 36">
                                    <path class="filled"
                                        d="M26 6H10V18V30C10 30 17.9746 23.5 18 23.5C18.0254 23.5 26 30 26 30V18V6Z" />
                                    <path class="default"
                                        d="M26 6H10V18V30C10 30 17.9746 23.5 18 23.5C18.0254 23.5 26 30 26 30V18V6Z" />
                                    <path class="corner"
                                        d="M10 6C10 6 14.8758 6 18 6C21.1242 6 26 6 26 6C26 6 26 6 26 6H10C10 6 10 6 10 6Z" />
                                </svg>
                            </div>
                            <span>Bookmark</span>
                        </button>
                    </form>
                </div>
                <div class="col-12 mb-3">
                    <div class="post-slider">
                        <img src="{{ asset('/storage/uploads/posts/' . $post->featured_image) }}" class="img-fluid"
                            alt="post-thumb" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="content mb-3">
                                <h5 class="paragraph"></h5>
                                <p>{!! $post->post_content !!}</p>
                            </div>
                            <div class="card-body mb-3">
                                <form method="POST" action="{{ route('post.comment', $post->id) }}">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label for="comment" class="d-flex flex-start gap-2">
                                            <h5 class="mt-1">Comment</h5>
                                            <i class="fa fa-comment" aria-hidden="true" id="comment-icon"></i>
                                        </label>
                                        <textarea name="comment" id="comment" class="form-control"></textarea>
                                    </div>
                                    @error('comment')
                                        <div class="mb-1">
                                            <span class="fw-bold text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                    <button type="submit" class="btn btn-primary">Send Now</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-4 mx-auto">
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
                            <!-- latest articles -->
                            <div class="widget">
                                <h5 class="widget-title"><span>Latest Articles</span></h5>
                                <!-- post-item -->
                                @foreach (latest_sidebar_posts($post->id) as $item)
                                    <ul class="list-unstyled widget-list">
                                        <li class="media widget-post align-items-center">
                                            <a href="{{ route('read_post', $item->post_slug) }}">
                                                <img loading="lazy" class="mr-3"
                                                    src="{{ asset('/storage/uploads/posts/thumbnails/thumb_' . $item->featured_image) }}">
                                            </a>
                                            <div class="media-body">
                                                <h5 class="h6 mb-0">
                                                    <a
                                                        href="{{ route('read_post', $item->post_slug) }}">{{ $item->post_title }}</a>
                                                </h5>
                                                <small>{{ date_formatter($post->created_at) }}</small>
                                            </div>
                                        </li>
                                    </ul>
                                @endforeach
                            </div>
                            <!-- tags -->
                            @if (tags_posts())
                                @php
                                    $postTagsString = tags_posts();
                                    $tagsArray = array_unique(explode(',', $postTagsString));
                                @endphp
                                <div class="widget">
                                    <h5 class="widget-title"><span>Tags</span></h5>
                                    <ul class="list-inline widget-list-inline">
                                        @foreach ($tagsArray as $tag)
                                            <li class="list-inline-item">
                                                <a href="{{ route('tag_posts', $tag) }}"
                                                    class="tags">#{{ $tag }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- related posts -->
                            @if (count($related_posts) > 0)
                                <div class="widget">
                                    <h5 class="widget-title"><span>Related Posts</span></h5>
                                    <!-- post-item -->
                                    @foreach ($related_posts as $item)
                                        <ul class="list-unstyled widget-list">
                                            <li class="media widget-post align-items-center">
                                                <a href="{{ route('read_post', $item->post_slug) }}">
                                                    <img loading="lazy" class="mr-3"
                                                        src="{{ asset('/storage/uploads/posts/thumbnails/thumb_' . $item->featured_image) }}"
                                                        alt="Post Thumbnail">
                                                </a>
                                                <div class="media-body">
                                                    <h5 class="h6 mb-0">
                                                        <a href="{{ route('read_post', $item->post_slug) }}">
                                                            {{ $item->post_title }}
                                                        </a>
                                                    </h5>
                                                    <p class="post_content mb-0">
                                                        {{ Str::ucfirst(words($item->post_content, 15)) }}</p>
                                                    <small>{{ date_formatter($post->created_at) }}</small>
                                                </div>
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- <div class="col-lg-10 max-auto mb-3">
                    <div id="disqus_thread"></div>
                    <script>
                        /**
                         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */

                        var disqus_config = function() {
                            this.page.url =
                                "{{ route('read_post', $post->post_slug) }}"; // Replace PAGE_URL with your page's canonical URL variable
                            this.page.identifier =
                                "{{ $post->id }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        };

                        (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document,
                                s = d.createElement('script');
                            s.src = 'https://blog-site-xtdusv51du.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>
                        Please enable JavaScript to view the
                        <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a>
                    </noscript>
                </div> --}}
            </article>
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="title-bordered mb-5 d-flex align-items-center">
                        @if ($comments)
                            <h1 class="h4">{{ count($comments) }} comments</h1>
                        @else
                            <h1 class="h4">0 comments</h1>
                        @endif
                        <ul class="list-inline social-icons ml-auto mr-3 d-none d-sm-block">
                            <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="#"><i class="ti-linkedin"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="#"><i class="ti-github"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                @if (count($comments) > 0)
                    <div class="col-lg-12">
                        <section style="background-color: #e7effd;">
                            <div class="container py-5 text-dark">
                                <div class="row d-flex">
                                    @foreach ($comments as $comment)
                                        <div class="col-md-11 col-lg-9 col-xl-7 comment">
                                            <div class="d-flex flex-start mb-4 next-reply">
                                                <img class="rounded-circle shadow-1-strong me-3"
                                                    src="{{ asset($comment->user->picture) }}" alt="avatar"
                                                    width="65" height="65" />
                                                <div class="card w-100">
                                                    <div class="card-body p-4">
                                                        <div class="">
                                                            <h5>{{ Str::ucfirst($comment->user->username) }}</h5>
                                                            <p class="small">{{ formatTimeAgo($comment->created_at) }}
                                                            </p>
                                                            <p>
                                                                {{ $comment->comment }}
                                                            </p>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <a href="#!" class="link-muted me-2"><i
                                                                            class="fa fa-thumbs-up me-1"></i>132</a>
                                                                    <a href="#!" class="link-muted"><i
                                                                            class="fa fa-thumbs-down me-1"></i>15</a>
                                                                    <a href="javascript:void(0)" class="show-reply"
                                                                        class="link-muted ml-3">
                                                                        Show replies
                                                                    </a>
                                                                </div>
                                                                <a href="javascript:void(0)" class="reply-btn"
                                                                    class="link-muted"><i class="fa fa-reply me-1"></i>
                                                                    Reply </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($comment->commentReplies)
                                                <div class="reply-section">
                                                    @foreach ($comment->commentReplies as $replyComment)
                                                        <div class="d-flex flex-start mb-4" id="reply-section">
                                                            <img class="rounded-circle shadow-1-strong me-3"
                                                                src="{{ asset($replyComment->user->picture) }}"
                                                                alt="avatar" width="65" height="65" />
                                                            <div class="card w-100">
                                                                <div class="card-body p-4">
                                                                    <div class="">
                                                                        <h5>{{ Str::ucfirst($replyComment->user->username) }}
                                                                        </h5>
                                                                        <p class="small">
                                                                            {{ formatTimeAgo($replyComment->created_at) }}
                                                                        </p>
                                                                        <p>
                                                                            {{ $replyComment->reply_comment }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-11 col-lg-9 col-xl-7 comment-reply-section">
                                            <div class="d-flex flex-start mb-3">
                                                <div class="card w-100">
                                                    <div class="card-body p-3">
                                                        <form action="{{ route('post.reply', $comment->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="comment" class="fw-bold"><i
                                                                        class="fa fa-reply" aria-hidden="true"></i> Your
                                                                    Reply </label>
                                                                <textarea name="replyComment" id="comment" class="form-control"></textarea>
                                                                @error('replyComment')
                                                                    <div class="mb-1">
                                                                        <span
                                                                            class="fw-bold text-danger">{{ $message }}</span>
                                                                    </div>
                                                                @enderror
                                                                <button type="submit"
                                                                    class="btn btn-info btn-sm float-right mt-2">Send</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection


@push('stylesheets')
    <link rel="stylesheet" href="/share_buttons/jquery.floating-social-share.min.css" />
    @vite(['resources/css/app.css'])
@endpush

@push('scripts')
    <script src="/share_buttons/jquery.floating-social-share.min.js"></script>
    <script>
        $("body").floatingSocialShare({
            buttons: [
                "facebook",
                "twitter",
                "linkedin",
                "pinterest",
                "reddit",
                "whatsapp",
                "reddit",
                "telegram"
            ],
            text: "share with:",
            url: "{{ route('read_post', $post->post_slug) }}"
        });

        $(document).ready(function() {
            // Check if the flag exists in localStorage
            var isFirstLoad = localStorage.getItem('isFirstLoad');

            // Hide the section on the first load
            if (isFirstLoad) {
                $('.comment-reply-section').hide();
                localStorage.setItem('isFirstLoad', false);
            }
            $('.reply-btn').on('click', function() {
                var replySection = $(this).closest('.comment').next('.comment-reply-section');
                var isInitialToggle = !replySection.is(':visible'); // Check if it's the initial toggle

                replySection.toggle();

                if (isInitialToggle) {
                    replySection.find('textarea').focus();
                }
            });

            // Check if the flag exists in localStorage
            var isSecondLoad = localStorage.getItem('isSecondLoad');

            // Hide the section on the first load
            if (isSecondLoad) {
                $('.reply-section').hide();
                localStorage.setItem('isSecondLoad', false);
            }
            $('.show-reply').on('click', function() {
                var replyComment = $(this).closest('.next-reply').next('.reply-section');
                var isInitialToggle2 = !replyComment.is(':visible'); // Check if it's the initial toggle

                replyComment.toggle();

                if (isInitialToggle2) {
                    replyComment.find('textarea').focus();
                }
            });
        })
    </script>
@endpush


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#myForm').submit(function(event) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                event.preventDefault(); // Prevent form submission

                var post = $('#postBookmark').val();

                $.ajax({
                    url: "{{ route('author.posts.bookmark-post') }}",
                    type: 'POST',
                    data: {
                        post: post
                    },
                    success: function(response) {
                        // Handle the response from the server
                        if (response.status == 'success') {
                           console.log('Post saved');
                        }
                        // You can update the page content or perform other actions as needed
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            });
        });
    </script>
@endpush
