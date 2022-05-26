<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function() {
    //Post Form Route
    Route::get("/posts/create", [PostController::class, "create"])->name("posts.create");

    //Store Post to db Route
    Route::post("/posts", [PostController::class, "store"])->name("posts.store");

    //View Post Route
    Route::get("/posts/{post}", [PostController::class, "show"])->name("posts.show");

    //Show edit form for a post route
    Route::get("/posts/{post}/edit", [PostController::class, "edit"])->name("posts.edit");

    //Update Post route
    Route::put("/posts/{post}", [PostController::class, "update"])->name("posts.update");

    //Delete Post route
    Route::delete("/posts/{post}", [PostController::class, "destroy"])->name("posts.destroy");
});