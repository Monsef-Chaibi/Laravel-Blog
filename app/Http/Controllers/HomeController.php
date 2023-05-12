<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() 
    {
        $pageTitle = "Home"; // Set the specific page title
        if(Auth::check()){
            return view('layouts.app', compact('pageTitle'));
        }
        return redirect("/login")->with('warning', 'Opps! You do not have access');
    }
}