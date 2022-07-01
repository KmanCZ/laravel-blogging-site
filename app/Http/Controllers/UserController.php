<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //Shows user profile view
    public function show(User $user) {
        if(auth()->check() && $user->id == auth()->user()->id) {
            return view("users.show", [
                "posts" => Post::where("user_id", "=", $user->id)->latest()->paginate(10),
                "user" => $user
            ]);
        }

        return view("users.show", [
            "posts" => Post::where([["user_id", "=", $user->id], ["public", "=", "1"]])->latest()->paginate(10),
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
            "email" => ['required', 'string', 'email', 'max:255', Rule::unique("users")->ignore(auth()->user())],
            "profile_picture" => ["image", "dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000", "max:2000"]
        ]);

        if(request()->hasFile("profile_picture")) {
            $userInfo["profile_picture"] = request()->file("profile_picture")->storeAs(auth()->user()->username, "profile_picture", "s3");
        }

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

    //Delete user and its posts
    public function destroy(User $user) {
        request()->validate([
            "password" => ['required', new MatchOldPassword, Rules\Password::defaults()]
        ]);

        Storage::deleteDirectory("public/".$user->username);

        $user->delete();

        return redirect(route("home"));
    }

    //Follow user
    public function follow(User $user) {
        $follower = User::find(auth()->user()->id);

        if($user == $follower) {
            return abort(409, 'Conflict');
        }

        if($user->followers()->get()->contains($follower)) {
            return abort(409, 'Already following this user');
        }

        $follower->following()->attach($user);

        return back();
    }

    //Unfollow user
    public function unfollow(User $user) {
        $follower = User::find(auth()->user()->id);

        if($user == $follower) {
            return abort(409, 'Conflict');
        }

        if(!$user->followers()->get()->contains($follower)) {
            return abort(409, "You aren't following this user");
        }

        $follower->following()->detach($user);

        return back();
    }

    //Show followers page
    public function followers(User $user) {
        return view("users.followers", [
            "followers" => $user->followers()->paginate(10),
            "user" => $user
        ]);
    }

    //Show followers page
   public function following(User $user) {
        return view("users.following", [
            "followings" => $user->following()->paginate(10),
            "user" => $user
        ]);
    }
}