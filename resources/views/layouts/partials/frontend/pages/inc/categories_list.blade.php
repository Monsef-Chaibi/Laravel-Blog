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