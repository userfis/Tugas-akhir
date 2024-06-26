<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class supAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){

            if(Auth::user()->is_admin == 0){
                return $next($request);
    
            }
            else{
                Auth::logout();
                return redirect(url('login'));
            }
            }
            else{
                Auth::logout();
                return redirect(url('login'));
            }
        }
    }
    // if (!auth()->check() || !auth()->user()->is_admin) {
    //     abort(430);
    // }
    // return $next($request);
