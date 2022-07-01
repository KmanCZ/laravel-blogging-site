<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', "verified"])->group(function() {
    //Create Comment Route
    Route::post("/{user}/{post}/comments", [CommentController::class, "store"])->name("comments.create");

    //Delete Comment Route
    Route::delete("/comments/{comment}", [CommentController::class, "destroy"])->name("commnets.destroy");

    //Update Comment Route
    Route::put("/comments/{comment}", [CommentController::class, "update"])->name("commnets.update");
});