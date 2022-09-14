<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('login')->middleware('authcheck');
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard', [UserController::class, 'index']);
    Route::post('/storeuser', [UserController::class, 'store']);
    Route::get('/deleteuser/{id}', [UserController::class, 'destroy']);
});
