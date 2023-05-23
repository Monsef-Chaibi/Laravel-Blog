<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LayoutsController extends Controller
{
    public function index()
    {
        $pageTitle = "Welcome to Blog"; // Set the specific page title
        $categories = Category::whereHas('subcategories', function ($query) {
            $query->whereHas('posts');
        })->orderby('ordering', 'ASC')->get();
        return view('layouts.partials.frontend.pages.inc.articles', compact('categories', "pageTitle"));
    }

    public function categoryPosts(Request $request, $slug)
    {
        if (!$slug) {
            return abort(404);
        } else {
            $subcategory = SubCategory::where('slug', $slug)->first();
            if (!$subcategory) {
                return abort(404);
            } else {
                $posts = Post::where('category_id', $subcategory->id)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(6);
                $data = [
                    'pageTitle' => 'Category - ' . $subcategory->subcategory_name,
                    'category' => $subcategory,
                    'posts' => $posts,
                ];
                return view('layouts.partials.frontend.pages.inc.category_posts', $data);
            }
        }
    }

    public function searchBlog(Request $request)
    {
        $query = request()->query('query');
        if ($query && strlen($query) >= 2) {
            $searchValues = preg_split('/\s+/', $query, -1, PREG_SPLIT_NO_EMPTY);
            $posts = Post::query();

            $posts->where(function ($query) use ($searchValues) {
                foreach ($searchValues as $value) {
                    $query->orWhere('post_title', 'LIKE', "%{$value}%");
                    $query->orWhere('post_tags', 'LIKE', "%{$value}%");
                }
            });
            $posts = $posts->with('subcategory')
                ->with('author')
                ->orderBy('created_at', 'DESC')
                ->paginate(6);
            $data = [
                'pageTitle' => 'Search for -> ' . request()->query('query'),
                'posts' => $posts
            ];

            return view('layouts.partials.frontend.pages.inc.search_posts', $data);
        } else {
            toastr()->warning('You need to complete the sentence');
        }
    }

    public function ReadPost($slug)
    {
        if (!$slug) {
            return abort(404);
        } else {
            $post = Post::where('post_slug', $slug)
                ->with('subcategory')
                ->with('author')
                ->first();
            $post_tags = explode(',', $post->post_tags);
            $related_posts = Post::where('id', '!=', $post->id)
                ->where(function ($query) use ($post_tags, $post) {
                    foreach ($post_tags as $item) {
                        $query->orWhere('post_tags', 'LIKE', "%$item%")
                            ->orWhere('post_title', 'LIKE', $post->post_title);
                    }
                })->inRandomOrder()
                ->take(3)
                ->get();;
            $data = [
                'pageTitle' => Str::ucfirst($post->post_title),
                'post' => $post,
                'related_posts' => $related_posts,
            ];

            return view('layouts.partials.frontend.pages.inc.single_post', $data);
        }
    }
}
