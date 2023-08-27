<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset(\App\Models\Setting::get()->first()->blog_logo) }}" alt="AdminLTE Logo"
            class="brand-image img-circle">
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset(auth()->user()->picture) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->username ?? Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a class="nav-link p-3 bg-light" href="{{ route('admin.categories') }}">
                        <i class="fa fa-server" aria-hidden="true"></i>
                        <p style="font-size: .8em;" class="p-2">
                            Categories & SubCategories
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.authors') }}" class="nav-link p-3 bg-light">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <p style="font-size: .8em;" class="p-2">
                            Authors
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link p-3 bg-light">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <p class="p-2">
                            Posts
                            <i class="fas fa-angle-left right" style="font-size: 2em;"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('author.posts.all_posts') }}" class="nav-link text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Posts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('author.posts.add-post') }}" class="nav-link text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Post</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.profile') }}" class="nav-link p-3 bg-light">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <p class="p-2">
                            Profile
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.settings') }}" class="nav-link p-3 bg-light">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <p class="p-2">
                            Settings
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
