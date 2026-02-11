<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkHoursOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $hour = now()->format('H');

        if ($request->priority === 'low' && ($hour >= 18 || $hour < 8)) {
            return redirect('/incidents/create');
        }

        return $next($request);
    }
}
