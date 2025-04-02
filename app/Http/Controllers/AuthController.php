<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   public function login(Request $request){
       $validate = $request->validate([
           'email' => 'required|email',
           'password' => 'required'
       ]);

       if(Auth::attempt($validate)){
         $user = Auth::user();
         if($user->role == 'admin'){
            return redirect('/category')->with('success', 'đăng nhập thành công');
         }else{
            return redirect('/list')->with('success', 'đăng nhập thành công');
         }
       }
       return back()->with(['email' => 'không đúng']);
   }
}
