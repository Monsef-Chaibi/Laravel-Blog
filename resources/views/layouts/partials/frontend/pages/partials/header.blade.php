<header class="sticky-top bg-white border-bottom border-default">
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-white">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img class="img-fluid" width="50px" height="40px" src="{{ asset(blogInfo()->blog_logo) }}"
                    alt="{{ asset(blogInfo()->blog_name) }}">
            </a>
            <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navigation">
                <i class="ti-menu"></i>
            </button>

            <div class="collapse navbar-collapse text-center" id="navigation">
                <ul class="navbar-nav ml-auto">
                    @if (Auth::check() && Auth::user()->role == 'admin')
                        <li class="new-item">

                            <a class="nav-link d-flex gap-2" href="{{ route('admin.dashboard') }}">
                                <i class="ti-panel my-auto"></i>
                                Dashboard
                            </a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            Categories <i class="ti-angle-down ml-1"></i>
                        </a>
                        <div class="dropdown-menu">
                            @foreach (\App\Models\SubCategory::whereHas('posts')->orderby('ordering', 'ASC')->get() as $subcategory)
                                <a class="dropdown-item"
                                    href="{{ route('category_posts', $subcategory->slug) }}">{{ $subcategory->subcategory_name }}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button"
                            aria-expanded="false">
                            Posts
                            <i class="ti-angle-down ml-1"></i>
                        </a>
                        <!-- Dropdown menu -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('author.posts.add-post') }}">Add new
                                    Post</a>
                            </li>
                        </ul>
                    </li>
                    @foreach (\App\Models\SubCategory::where('parent_category', 0)->whereHas('posts')->orderby('ordering', 'ASC')->get() as $subcategory)
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('category_posts', $subcategory->slug) }}">{{ $subcategory->subcategory_name }}</a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                    <!-- Avatar -->
                    @auth
                        <li class="nav-item dropdown mb-3 my-auto">
                            <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#"
                                id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
                                <img src="{{ asset(Auth::user()->picture) }}" class="rounded-circle avatar" height="25"
                                    alt="Black and White Portrait of a Man" loading="lazy" />
                                <i class="ti-angle-down ml-1 my-auto"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item py-0" href=""
                                    aria-disabled="true">{{ auth()->user()->username }}</a>
                                @if (Auth::user()->role == 'admin')
                                    <a class="dropdown-item py-0" href="{{ route('admin.profile') }}">My profile</a>
                                @else
                                    <a class="dropdown-item py-0" href="{{ route('author.profile') }}">My profile</a>
                                @endif
                                @if (Auth::check() && Auth::user()->role == 'admin')
                                    <a class="dropdown-item py-0" href="{{ route('admin.settings') }}">Settings</a>
                                @endif
                                <hr class="dropdown-divider py-0" />
                                @auth
                                    <a href="{{ route('logout.perform') }}" class="dropdown-item py-0">Logout</a>
                                @endauth
                            </div>
                        </li>
                    @endauth
                </ul>

                {{-- <select class="m-2 border-0" id="select-language">
                    <option id="en" value="about/" selected>En</option>
                    <option id="fr" value="fr/about/">Fr</option>
                </select> --}}

                <div class="d-flex align-items-center me-4 right-elements">
                    <!-- Icon -->
                    @guest
                        <a href="{{ route('login.perform') }}" class="btn btn-sm btn-success btn-rounded me-2">Login</a>
                        <a href="{{ route('register.perform') }}" class="btn btn-info btn-sm btn-rounded me-2">Sign-up</a>
                    @endguest
                </div>

                <!-- search -->
                <div class="search px-4">
                    <button id="searchOpen" class="search-btn"><i class="ti-search"></i></button>
                    <div class="search-wrapper">
                        <form action="{{ route('search_posts') }}" class="h-100">
                            <input class="search-box pl-4" id="search-query" value="{{ Request('query') }}"
                                name="query" type="search" placeholder="Type &amp; Hit Enter...">
                        </form>
                        <button id="searchClose" class="search-close"><i class="ti-close text-dark"></i></button>
                    </div>
                </div>

            </div>
        </nav>
    </div>
</header>
