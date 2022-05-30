<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function() {
    //Show user settings page
    Route::get("users/settings", [UserController::class, "edit"])->name("users.edit");

    //Update user information
    Route::put("/users/{user}", [UserController::class, "update"])->name("users.update");
});

//Show user profile page
Route::get("/users/{user}", [UserController::class,"show"])->name("users.show");