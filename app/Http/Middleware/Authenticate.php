<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        if (!$request->expectsJson()) {
            if ($request->routeIs(['author.*', 'admin.*'])) {
                toastr()->error('You must sign in first');
                return route('login', ['fail'=> true, 'returnUrl'=> URL::current()]);
            }
        }
        // return $request->expectsJson() ? null : route('login');
    }
}
