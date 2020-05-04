<?php

namespace sisVentas\Http\Middleware;

use sisVentas\Http\Middleware\Almacenero;
use sisVentas\Http\Middleware\Auth;
use Closure;

class Almacenero
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
        
        if (\Auth::user()->rolID==4 or \Auth::user()->rolID==3) {
        return $next($request);
        }
        
        return redirect('resumen');
        
    }
}
