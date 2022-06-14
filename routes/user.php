<?php
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function() {
    //Show user settings page
    Route::get("users/settings", [UserController::class, "edit"])->name("users.edit");

    //Update user information
    Route::put("/{user}/update/informations", [UserController::class, "informationsUpdate"])->name("users.update.informations");

    //Update user password
    Route::patch("/{user}/update/password", [UserController::class, "passwordUpdate"])->name("users.update.password");

    //Delete user and its posts
    Route::delete("/{user}",[UserController::class, "destroy"])->name("users.destroy");

    //Follow user
    Route::put("/{user}/follow", [UserController::class, "follow"])->name("users.follow");

    //Unfollow user
    Route::delete("{user}/unfollow", [UserController::class, "unfollow"])->name("users.unfollow");
});

//Show user profile page
Route::get("/{user}", [UserController::class,"show"])->name("users.show");