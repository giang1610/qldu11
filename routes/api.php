<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Container\Attributes\Auth;
use Laravel\Sanctum\Sanctum;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/login', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// Route::apiResource('/testapi',CategoryController::class);
// Route::get('/',[UserController::class,'index']);
Route::get('/users', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Các route cần middleware auth:sanctum ở đây
});


