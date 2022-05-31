<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

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
    public function informationsUpdate() {
        $userInfo = request()->validate([
            "name" => ['required', 'string', 'max:255'],
            "email" => ['required', 'string', 'email', 'max:255', Rule::unique("users")->ignore(auth()->user())]
        ]);

        User::find(auth()->user()->id)->update($userInfo);

        return back();
    }

    //Updates user password
    public function passwordUpdate() {
        $validatedData = request()->validate([
            "newPassword" => ['required', 'confirmed', Rules\Password::defaults()],
            'oldPassword' => ['required', new MatchOldPassword, Rules\Password::defaults()]
        ]);

        User::find(auth()->user()->id)->update(["password" => Hash::make($validatedData["newPassword"])]);

        return back();
    }
}