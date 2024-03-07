<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class LanguageMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('locale')) {
            App::setLocale(session('locale'));
            Cookie::queue('locale', session('locale'), 60);
        } else {
            App::setLocale(config('app.locale'));
            Cookie::queue('locale', config('app.locale'), 60);
        }
        return $next($request);
    }
}
