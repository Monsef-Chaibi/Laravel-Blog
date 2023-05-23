<aside class="col-lg-4">
    <!-- Search -->
    <div class="widget">
        <h5 class="widget-title"><span>Search</span></h5>
        <form action="/logbook-hugo/search" class="widget-search">
            <input id="search-query" name="s" type="search" placeholder="Type &amp; Hit Enter...">
            <button type="submit"><i class="ti-search"></i>
            </button>
        </form>
    </div>
    <!-- categories -->
    @include('layouts.partials.frontend.pages.inc.categories_list')
    <!-- tags -->
    <div class="widget">
        <h5 class="widget-title"><span>Tags</span></h5>
        <ul class="list-inline widget-list-inline">
            <li class="list-inline-item"><a href="#!">Booth</a>
            </li>
            <li class="list-inline-item"><a href="#!">City</a>
            </li>
            <li class="list-inline-item"><a href="#!">Image</a>
            </li>
            <li class="list-inline-item"><a href="#!">New</a>
            </li>
            <li class="list-inline-item"><a href="#!">Photo</a>
            </li>
            <li class="list-inline-item"><a href="#!">Seasone</a>
            </li>
            <li class="list-inline-item"><a href="#!">Video</a>
            </li>
        </ul>
    </div>
    <!-- latest post -->
    <div class="widget">
        <h5 class="widget-title"><span>Latest Articles</span></h5>
        <!-- post-item -->
        @if (latest_posts())
            @foreach (latest_posts() as $latest_posts)
                <ul class="list-unstyled widget-list">
                    <li class="media widget-post align-items-center">
                        <a href="{{ route('read_post', $latest_posts->post_slug) }}">
                            <img loading="lazy" class="mr-3"
                                src="{{ asset('storage/uploads/posts/thumbnails/thumb_' . $latest_posts->featured_image) }}"
                                alt="Post Thumbnail">
                        </a>
                        <div class="media-body">
                            <h5 class="h6 mb-0">
                                <a href="{{ route('read_post', $latest_posts->post_slug) }}">
                                    {{ $latest_posts->post_title }}
                                </a>
                            </h5>
                            <small>{{ date_formatter($latest_posts->created_at) }}</small>
                        </div>
                    </li>
                </ul>
            @endforeach
        @endif
    </div>
    <!-- Recommended posts -->
    <div class="widget">
        <h5 class="widget-title"><span>Recommended</span></h5>
        <!-- post-item -->
        @if (recommended_posts())
            @foreach (recommended_posts() as $recommended_posts)
                <ul class="list-unstyled widget-list">
                    <li class="media widget-post align-items-center">
                        <a href="{{ route('read_post', $recommended_posts->post_slug) }}">
                            <img loading="lazy" class="mr-3"
                                src="{{ asset('storage/uploads/posts/thumbnails/thumb_' . $recommended_posts->featured_image) }}"
                                alt="Post Thumbnail">
                        </a>
                        <div class="media-body">
                            <h5 class="h6 mb-0">
                                <a href="{{ route('read_post', $recommended_posts->post_slug) }}">
                                    {{ $recommended_posts->post_title }}
                                </a>
                            </h5>
                            <p class="post_content mb-0">{!! Str::ucfirst(words($recommended_posts->post_content, 7)) !!}</p>
                            <small>{{ date_formatter($recommended_posts->created_at) }}</small>
                        </div>
                    </li>
                </ul>
            @endforeach
        @endif
    </div>
</aside>
