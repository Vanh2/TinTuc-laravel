<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Hello
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
        // các code xử lý sẽ đặt ở đây
        echo "<h1>Middleware Hello được gọi</h1>";
        return $next($request);
    }
}