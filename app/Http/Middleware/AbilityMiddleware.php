<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AbilityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $route = $request->route();
        // @dd($route);
        $resource = $route->getName();
        // @dd($resource); 
        if (!isset(config('abilities')[$resource])) {
            abort(403, "Ability [$resource] not defined.");
        }   

        $user = $request->user();

        if (!$user || !$user->hasAbilities($resource)) {
            return redirect()->route('dashboard')->with('delete', "You don't have permission to access this resource.");
        }
        return $next($request);
    }
}
