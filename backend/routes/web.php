<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

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

// ブログ一覧画面を表示(名前付きURL:blogs)
Route::get('/', [BlogController::class, 'showList'])->name("blogs");
// ブログ登録画面を表示(名前付きURL:blog/create)
Route::get('/blog/create', [BlogController::class, 'showCreate'])->name("create");
// ブログ登録(名前付きURL:blog/store)
Route::post('/blog/store', [BlogController::class, 'exeStore'])->name("store");
// ブログ詳細画面を表示(名前付きURL:blog/id)
Route::get('/blog/{id}', [BlogController::class, 'showDetail'])->name("show");
