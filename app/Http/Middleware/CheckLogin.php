<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // kiểm tra xem là user đã đăng nhập chưa
        //url("login") -> tạo url 
        //redirect -> di chuyển đến 1 url
        if (Auth::check() == false)
            return redirect(url("login"));
        return $next($request);
    }
}