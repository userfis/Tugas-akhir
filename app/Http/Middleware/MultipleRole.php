<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MultipleRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Check if user has one of the specified roles
            foreach ($roles as $role) {
                if ($user->is_admin == $role) {
                    return $next($request);
                }
            }

            // Auth::logout();
            // return redirect(url('login'))->with('error', 'You do not have access to this page.');
            throw new NotFoundHttpException();
        }

        return redirect(url('login'))->with('error', 'Please login to access this page.');
    }
}
