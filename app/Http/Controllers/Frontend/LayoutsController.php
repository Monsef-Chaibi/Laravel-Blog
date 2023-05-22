<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class LayoutsController extends Controller
{
    public function index()
    {
        $categories = Category::whereHas('subcategories', function ($query) {
            $query->whereHas('posts');
        })->orderby('ordering','ASC')->get();
        return view('layouts.partials.frontend.pages.pages-layouts', compact('categories'));
    }
}
