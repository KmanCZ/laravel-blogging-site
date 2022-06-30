<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //Index page with all the posts
    public function index() {
        return view("posts.index", [
            "posts" => Post::latest()->where("public", "=", "1")->paginate(10)
        ]);
    }

    //Saves image for post
    public function image() {
        request()->validate([
            "image" => ["required", "image", "max:5000"]
        ]);

        if(request()->hasFile("image")) {
            $userInfo["image"] = request()->file("image")->storeAs(auth("api")->user()->username, Str::random(10), "public");
        }

        return $userInfo["image"];
    }

    //Serch posts
    public function search() {
        return view("posts.search", [
            "posts" => Post::latest()->filter(request(["q"]))->where("public", "=", "1")->paginate(10),
            "query" => request()->query("q")
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
            "content" => ["required", "string"],
            "tags" => ["required", "string"],
            "cover_image" => ["image", "dimensions:min_width=100,min_height=100,max_width=5000,max_height=5000", "max:5000"],
            "public" => ["required", "boolean"]
        ]);

        $validatedData["slug"] = Str::slug($validatedData["heading"]);
        $validatedData["user_id"] = auth()->user()->id;

        if(request()->hasFile("cover_image")) {
            $validatedData["cover_image"] = request()->file("cover_image")->storeAs(auth()->user()->username, $validatedData["slug"], "public");
        }

        Post::create($validatedData);

        return redirect(route("posts.show", ["post" => $validatedData["slug"], "user" => auth()->user()]));
    }

    //Show specific post
    public function show(User $user, Post $post) {
        if($post->public != 1 && (!auth()->check() || $user->id != auth()->user()->id)) {
            return abort(403, 'Unauthorized Action');
        }

        return view("posts.show", [
            "post" => $post,
            "comments" => $post->comments()->latest()->paginate(20)
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

        $validatedData = request()->validate([
            "content" => ["required", "string"],
            "tags" => ["required", "string"],
            "cover_image" => ["image", "dimensions:min_width=100,min_height=100,max_width=5000,max_height=5000", "max:5000"],
            "public" => ["required", "boolean"]
        ]);

        if(request()->hasFile("cover_image")) {
            $validatedData["cover_image"] = request()->file("cover_image")->storeAs(auth()->user()->username, $post->slug, "public");
        }

        $post->update($validatedData);

        return redirect(route("posts.show", ["post" => $post->slug, "user" => auth()->user()]));
    }

    //Delete post
    public function destroy(Post $post) {
        if($post->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        Storage::delete("public/".$post->cover_image);

        $post->delete();

        if (!str_contains(back()->getTargetUrl(), $post->slug)) {
            return back();
        } else {
            return redirect(route("home"));
        }
    }

    //Shows page with posts from people you follow
    public function following() {
        $user = User::find(auth()->user()->id);
        $ids = [];

        foreach ($user->following()->get() as $following) {
            array_push($ids, $following->id);
        }

        return view("posts.following", [
            "posts" => Post::whereIn("user_id", $ids)->latest()->where("public", "=", "1")->paginate(10)
        ]);
    }

    //Like post
    public function like(User $user, Post $post) {
        if($post->likes()->get()->contains(auth()->user())) {
            return abort(409, "Conflict");
        }

        $post->likes()->attach(auth()->user());

        return back();
    }

    //Unlike post
    public function unlike(User $user, Post $post) {
        if(!$post->likes()->get()->contains(auth()->user())) {
            return abort(409, "Conflict");
        }

        $post->likes()->detach(auth()->user());

        return back();
    }
}