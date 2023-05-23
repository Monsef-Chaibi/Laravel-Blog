<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Http\Request;

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
                    'pageTitle' => 'Category - '. $subcategory->subcategory_name,
                    'category' => $subcategory,
                    'posts' => $posts,
                ];
                return view('layouts.partials.frontend.pages.inc.category_posts', $data);
            }
        }
    }
}
