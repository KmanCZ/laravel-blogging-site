<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Show user profile view
    public function show(User $user) {
        return view("users.show", [
            "user" => $user
        ]);
    }
}