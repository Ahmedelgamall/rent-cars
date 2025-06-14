<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanDo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$permission)
    {
        if(auth()->check()){
            if(auth()->user()->can($permission)){
                return $next($request);
            }
            else {
                return abort(403);
            }
            
        }
    
       
        return redirect()->route('login');
    }
}
