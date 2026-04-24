<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('locale')) {
            $locale = session('locale');
        } else {
            $preferred = $request->getPreferredLanguage(['pt_BR', 'en']);
            $locale = $preferred ?? 'pt_BR';
        }

        App::setLocale($locale);

        return $next($request);
    }
}
