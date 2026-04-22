<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = session('locale', 'pt_BR');

        if (!in_array($locale, ['pt_BR', 'en'])) {
            $locale = 'pt_BR';
        }

        App::setLocale($locale);

        return $next($request);
    }
}
