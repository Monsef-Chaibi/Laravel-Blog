<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="#">
                <img src="{{ asset(\App\Models\Setting::get()->first()->blog_logo) }}" height="40" alt="MDB Logo"
                    loading="lazy" />
            </a>
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Team</a>
                </li>
                <!-- Navbar dropdown -->
                @if (Auth::check() && Auth::user()->role == 'admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            aria-expanded="false">
                            Posts
                        </a>
                        <!-- Dropdown menu -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('author.posts.add-post') }}">Add new Post</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('author.posts.all_posts') }}">All Posts</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.categories') }}">Menus & Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.authors') }}">Authors</a>
                    </li>
                @endif
            </ul>
            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->
        <!-- Search Box -->
        <form class="d-flex input-group w-auto search-box">
            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                aria-describedby="search-addon" />
            <span class="input-group-text border-0" id="search-addon">
                <i class="fas fa-search"></i>
            </span>
        </form>
        <!-- Right elements -->
        <div class="d-flex align-items-center me-4 right-elements">
            <!-- Icon -->
            @guest
                <a href="{{ route('login.perform') }}" class="btn btn-success btn-rounded me-2">Login</a>
                <a href="{{ route('register.perform') }}" class="btn btn-info btn-rounded me-2">Sign-up</a>
            @endguest
            @auth
                <a class="text-reset me-3" href="#">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <!-- Notifications -->
                <div class="dropdown">
                    <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
                        role="button" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge rounded-pill badge-notification bg-danger">1</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="#">Some news</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Another news</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </li>
                    </ul>
                </div>
            @endauth

            <!-- Avatar -->
            @auth
                <div class="dropdown">
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#"
                        id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
                        <img src="{{ asset(Auth::user()->picture) }}" class="rounded-circle" height="25"
                            alt="Black and White Portrait of a Man" loading="lazy" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item" href="#" aria-disabled="true"
                                aria-disabled="true">{{ auth()->user()->username }}</a>
                        </li>

                        @if (Auth::check() && Auth::user()->role == 'admin')
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.profile') }}">My profile</a>
                            </li>
                        @else
                            <li>
                                <a class="dropdown-item" href="{{ route('author.profile') }}">My profile</a>
                            </li>
                        @endif
                        @if (Auth::check() && Auth::user()->role == 'admin')
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.settings') }}">Settings</a>
                            </li>
                        @endif
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        @auth
                            <li>
                                <a href="{{ route('logout.perform') }}" class="dropdown-item">Logout</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            @endauth
            @auth
                <!-- Toggle button Sidebar -->
                <button id="toggler" class="btn btn-info btn-sm mx-4 ripple-surface" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <i class="fas fa-align-left"></i>
                </button>
            @endauth
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>
