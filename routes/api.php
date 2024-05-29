<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route để đăng nhập
Route::post('/login', [AuthController::class, 'login']);

// Route bảo mật bằng Sanctum để lấy thông tin người dùng đã đăng nhập
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route resource người dùng để quản lý CRUD
Route::apiResource('users', UserController::class);
Route::get('user/{id}', [UserController::class, 'show']);

Route::apiResource('attendance', AttendanceController::class);
Route::get('attendance/{id}',[AttendanceController::class, 'show']);

// Route cho chức năng "check in" và "check out" 
Route::middleware('auth:sanctum')->post('attendance/{type}', [AttendanceController::class, 'attendance']);

