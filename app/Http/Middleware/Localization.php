<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $locale = Str::lower( Str::before(Str::before( $request->server('HTTP_ACCEPT_LANGUAGE'), ','), '-'));

        if ($request->session()->has('locale')) {
            $locale = $request->session()->get('locale');
        }
       
        if (!in_array($locale, config('app.available_locales'))) {
            $locale = 'en';
        }

        config(['app.locale' => $locale]);

        return $next($request);
    }
}
