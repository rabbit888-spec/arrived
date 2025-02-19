<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminAuthority
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //判断用户是否已登录
        $userInfo = session('userInfo');
        if (!$userInfo) {
            return redirect('/');
        }
        //判断登录的用户是否是admin
        if ($userInfo['role_id'] != 1) {
            return redirect('/');
        }

        return $next($request);
    }
}
