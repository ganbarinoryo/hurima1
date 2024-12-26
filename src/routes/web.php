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

// トップページ
Route::get('/', [TopController::class, 'top']);

//会員登録（GET）
Route::get('/auth/register', [AuthController::class, 'register']);
// 会員登録処理（POST）
Route::post('/auth/register', [AuthController::class, 'registerSubmit']);

Route::get('/auth/login', [AuthController::class, 'login']);
