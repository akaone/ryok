<?php

namespace App\Http\Middleware;

use Closure;

class IsReady
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $path = $request->path();
        if(($path == 'en' || $path == 'fr')) {
            return $next($request);
        } else {
            return redirect()->route('home.index');
        }
    }
}
