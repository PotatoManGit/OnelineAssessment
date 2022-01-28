<?php

use App\Http\Controllers\Index;
use App\Http\Controllers\User\SignIn;
use Illuminate\Support\Facades\Route;


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
Route::any('/user/sign_in/', [SignIn::class, "SignIn"]);
