<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Shows user profile view
    public function show(User $user) {
        return view("users.show", [
            "user" => $user
        ]);
    }

    //Shows user settings page
    public function edit() {
        return view("users.edit");
    }

    //Updates users informations
    public function update() {
        $user = auth()->user();

        $userInfo = request()->validate([
            "name" => ['required', 'string', 'max:255'],
            "email" => ['required', 'string', 'email', 'max:255', Rule::unique("users")->ignore($user)]
        ]);

        $user->name = $userInfo["name"];
        $user->email = $userInfo["email"];
        $user->save();

        return back();
    }
}