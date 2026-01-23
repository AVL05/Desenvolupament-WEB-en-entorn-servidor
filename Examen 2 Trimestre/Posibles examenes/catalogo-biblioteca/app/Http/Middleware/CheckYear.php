<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckYear
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Se comprueba si existe el parámetro y es menor que 1900
        $year = $request->input('year');

        if ($year && intval($year) < 1900) {
             return redirect('/catalog');
        }

        return $next($request);
    }
}
