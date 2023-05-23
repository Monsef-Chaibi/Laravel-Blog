<header class="sticky-top bg-white border-bottom border-default">
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-white">
            <a class="navbar-brand" href="index.html">
                <img class="img-fluid" width="50px" height="40px" src="{{ asset(blogInfo()->blog_logo) }}"
                    alt="{{ asset(blogInfo()->blog_name) }}">
            </a>
            <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navigation">
                <i class="ti-menu"></i>
            </button>

            <div class="collapse navbar-collapse text-center" id="navigation">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            Categories <i class="ti-angle-down ml-1"></i>
                        </a>
                        <div class="dropdown-menu">
                            @foreach (category() as $category)
                                <a class="dropdown-item" href="{{ route('category_posts', $category->category_name) }}">{{ $category->category_name }}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            SubCategories <i class="ti-angle-down ml-1"></i>
                        </a>
                        <div class="dropdown-menu">
                            @foreach (\App\Models\SubCategory::whereHas('posts')->orderby('ordering', "ASC")->get() as $subcategory)
                                <a class="dropdown-item" href="{{ route('category_posts', $subcategory->slug) }}">{{ $subcategory->subcategory_name }}</a>
                            @endforeach
                        </div>
                    </li>
                    @foreach (\App\Models\SubCategory::where('parent_category', 0)->whereHas('posts')->orderby('ordering', 'ASC')->get() as $subcategory)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category_posts', $subcategory->slug) }}">{{ $subcategory->subcategory_name }}</a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">Pages <i class="ti-angle-down ml-1"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="author.html">Author</a>
                            <a class="dropdown-item" href="post-details-1.html">Post Details 1</a>
                            <a class="dropdown-item" href="post-details-2.html">Post Details 2</a>
                            <a class="dropdown-item" href="post-elements.html">Post Elements</a>
                            <a class="dropdown-item" href="privacy-policy.html">Privacy Policy</a>
                            <a class="dropdown-item" href="terms-conditions.html">Terms Conditions</a>
                        </div>
                    </li>
                </ul>

                <select class="m-2 border-0" id="select-language">
                    <option id="en" value="about/" selected>En</option>
                    <option id="fr" value="fr/about/">Fr</option>
                </select>

                <!-- search -->
                <div class="search px-4">
                    <button id="searchOpen" class="search-btn"><i class="ti-search"></i></button>
                    <div class="search-wrapper">
                        <form action="{{ route('search_posts') }}" class="h-100">
                            <input class="search-box pl-4" id="search-query" value="{{ Request('query') }}" name="query" type="search"
                                placeholder="Type &amp; Hit Enter...">
                        </form>
                        <button id="searchClose" class="search-close"><i class="ti-close text-dark"></i></button>
                    </div>
                </div>

            </div>
        </nav>
    </div>
</header>
