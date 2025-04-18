<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if(!Auth::check()){
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập trước!');
        }

        if(!in_array(Auth::user()->role, $roles)){
            return redirect()->route('login')->with('error', 'Bạn không có quyền truy cập!');
        }

        return $next($request);
    }
}
