<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Show user profile page
Route::get("/users/{user}", [UserController::class,"show"])->name("users.show");