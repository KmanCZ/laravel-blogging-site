<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function() {
    //Post Form Route
    Route::post("/{user}/{post}/comments", [CommentController::class, "create"])->name("comments.create");
});