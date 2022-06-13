<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PostController extends Controller
{
    //Index page with all the posts
    public function index() {
        return view("posts.index", [
            "posts" => Post::latest()->paginate(10)
        ]);
    }

    //Create post form
    public function create() {
        return view("posts.create");
    }

    //Store post to db
    public function store() {
        $validatedData = request()->validate([
            "heading" => ["required", "unique:posts,heading", "string", 'max:255'],
            "content" => ["required", "string"]
        ]);

        $validatedData["slug"] = Str::slug($validatedData["heading"]);
        $validatedData["user_id"] = auth()->user()->id;

        Post::create($validatedData);

        return redirect(route("posts.show", ["post" => $validatedData["slug"], "user" => auth()->user()]));
    }

    //Show specific post
    public function show(User $user, Post $post) {
        return view("posts.show", [
            "post" => $post
        ]);
    }

    //Show post edit form
    public function edit(User $user, Post $post) {
        if($post->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        return view("posts.edit", [
            "post" => $post
        ]);
    }

    //Update post
    public function update(Post $post) {
        if($post->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = request()->validate([
            "content" => ["required", "string"]
        ]);

        $post->update($formFields);

        return redirect(route("posts.show", ["post" => $post->slug, "user" => auth()->user()]));
    }

    //Delete post
    public function destroy(Post $post) {
        if($post->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $post->delete();

        if (!str_contains(back()->getTargetUrl(), $post->slug)) {
            return back();
        } else {
            return redirect(route("home"));
        }
    }
}