<?php

use App\Http\Controllers\Index;
use App\Http\Controllers\User\SignIn;
use App\Http\Controllers\Work\Work;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Work\Entry;


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

Route::any('/', [Index::class, "index"]);

// 用户相关路由
Route::any('/user/sign_in', [SignIn::class, "SignIn"]);
Route::post('/user/sign_in/check', [SignIn::class, "SignInCheck"]);
Route::any('/work', [Work::class, 'Work'])->middleware('user_control');
Route::any('/work', [Entry::class, 'Entry'])->middleware('user_control');
