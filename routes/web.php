<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/', [PostController::class, "index"])->name('home');
Route::get("/search", [PostController::class, "search"])->name("search");
//Posts from users you follow
Route::get("/following", [PostController::class, "following"])->name("posts.following");

require __DIR__.'/auth.php';
require __DIR__."/user.php";
require __DIR__."/post.php";
require __DIR__."/comment.php";