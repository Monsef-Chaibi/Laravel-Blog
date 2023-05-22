<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class LayoutsController extends Controller
{
    public function index()
    {
        $pageTitle = "Welcome to Blog"; // Set the specific page title
        $categories = Category::whereHas('subcategories', function ($query) {
            $query->whereHas('posts');
        })->orderby('ordering', 'ASC')->get();
        return view('layouts.partials.frontend.pages.pages-layouts', compact('categories', "pageTitle"));
    }

    public function readPost()
    {
        return view('layouts.partials.frontend.pages.inc.content-wrapper');
    }
}
