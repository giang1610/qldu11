<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {
        //check xác thực xem đang nhập hay chưa
        if(!Auth::check()){
            return redirect('/login');
           }
           //Kiểm tra xem người dùng đang nhập có phải là admin hay không
           if(Auth::user()->role !== 'admin') {
            return redirect('/list')->with('error', 'Bạn không có quyền truy cập vào trang này.');
           }
        return $next($request);
    }
}
