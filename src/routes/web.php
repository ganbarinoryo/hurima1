<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\AuthController;


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

Route::get('/', [TopController::class, 'top']);

// 会員登録ページ（登録フォームの表示）
Route::get('/register', [AuthController::class, 'register']);

// ログインページ（ログインフォームの表示）
Route::get('/login', [AuthController::class, 'login']);