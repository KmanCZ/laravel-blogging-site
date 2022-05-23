<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function() {
    //Post Form Route
    Route::get("/posts/create", [PostController::class, "create"])->name("posts.create");

    //Store Post to db Route
    Route::post("/posts", [PostController::class, "store"]);

    //View Post Route
    Route::get("/posts/{post}", [PostController::class, "show"]);
});