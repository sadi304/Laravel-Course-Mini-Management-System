<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::User();
        
        if( $user->role != $role ) {
            
            return redirect()->route('sdashboard');
            
        }
        
        return $next($request);
    }
}
