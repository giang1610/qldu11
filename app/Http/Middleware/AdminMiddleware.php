<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;


class AdminMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {
        //check xác thực xem đang nhập hay chưa
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRole = Auth::user()->role;
        Log::info("User role: {$userRole}"); // Debug log for role

        if ($userRole !== 'admin') {
            return redirect('/list')->with('error', 'Bạn không có quyền truy cập vào trang này.');
        }

        return $next($request);
    }
}
