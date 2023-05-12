<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        $pageTitle = "Home"; // Set the specific page title
        return view('layouts.app', compact('pageTitle'));
    }
}