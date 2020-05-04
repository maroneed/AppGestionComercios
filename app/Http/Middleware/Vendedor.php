<?php

namespace sisVentas\Http\Middleware;

use Closure;

class Vendedor
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
        if (\Auth::user()->rolID==2 or \Auth::user()->rolID==3) {
        return $next($request);
        }
        
        return redirect('resumen');
    }
}
