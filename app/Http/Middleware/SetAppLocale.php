<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetAppLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('lang')) {
            $locale = $request->get('lang');
            session(['locale' => $locale]);
            Cookie::queue('locale', $locale, 60 * 24 * 30);
        }
        $locale = session('locale', Cookie::get('locale', config('app.locale', 'ar')));
        App::setLocale($locale);

        URL::defaults(['lang' => $locale]); // Set default 'lang' parameter for all URLs
        Route::current()->forgetParameter('lang'); // Remove 'lang' from current route parameters
        return $next($request);
    }
}
