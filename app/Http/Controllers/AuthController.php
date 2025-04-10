<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validate)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect('/categories')->with('success', 'Đăng nhập thành công');
            } else {
                return redirect('/list')->with('success', 'Đăng nhập không thành công');
            }
        }
        return back()->withInput()->withErrors([
            'email' => 'Tài khoản hoặc mật khẩu không đúng',
        ]);
    }
}