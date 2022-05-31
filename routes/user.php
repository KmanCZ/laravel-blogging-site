<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function() {
    //Show user settings page
    Route::get("users/settings", [UserController::class, "edit"])->name("users.edit");

    //Update user information
    Route::put("/users/{user}/update/informations", [UserController::class, "informationsUpdate"])->name("users.update.informations");

    //Update user password
    Route::patch("/users/{user}/update/password", [UserController::class, "passwordUpdate"])->name("users.update.password");
});

//Show user profile page
Route::get("/users/{user}", [UserController::class,"show"])->name("users.show");