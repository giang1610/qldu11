<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DatVeDuLichController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return view('client.home');
});

Route::get('login',function(){
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class,'login']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


    Route::middleware('client')->group(function(){
        Route::get('/list', [HomeController::class, 'index'])->name('list');
        Route::get('/product/{product}', [HomeController::class, 'show'])->name('client.show');
        Route::get('/dat-ve/{product}', [HomeController::class, 'form'])->name('client.dat');
        Route::post('/dat-ve/{product}', [DatVeDuLichController::class, 'store'])->name('client.dat.store');
        Route::get('/listve', [DatVeDuLichController::class, 'index'])->name('client.listve');
        Route::post('/huy-ve/{id}', [DatVeDuLichController::class, 'destroy'])->name('client.huyve');
    });


Route::middleware('admin')->group(function(){
    Route::resource('categories',CategoryController::class);
    Route::resource('products',ProductController::class);
    Route::get('/admin/tickets', [DatVeDuLichController::class, 'index2'])->name('admin.tickets.index2');

});

