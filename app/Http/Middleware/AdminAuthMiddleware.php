<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //dd(route('admin#loginPage'));
        //dd(url()->current());
        if(!empty(Auth::user())){
            if(url()->current() == route('auth#loginPage') || url()->current() == route('auth#registerPage')){
                return back();
            }

            if(Auth::user()->role == 'user'){
                return back();
            }
            return $next($request);
        } // Login win htr yin true - ma win htar yin false

        return $next($request);
    }
}
