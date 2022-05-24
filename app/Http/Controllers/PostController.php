<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //Index page with all the posts
    public function index() {
        return view("posts.index", [
            "posts" => Post::latest()->get()
        ]);
    }

    //Create post form
    public function create() {
        return view("posts.create");
    }

    //Store post to db
    public function store() {
        $validatedData = request()->validate([
            "heading" => "required",
            "content" => "required"
        ]);

        Post::create($validatedData);

        return redirect("/home");
    }

    //Show specific post
    public function show(Post $post) {
        return view("posts.show", [
            "post" => $post
        ]);
    }

    //Show post edit form
    public function edit(Post $post) {
        return view("posts.edit", [
            "post" => $post
        ]);
    }

    //Update post
    public function update(Post $post) {
        $formFields = request()->validate([
            "content" => "required"
        ]);

        $post->update($formFields);

        return redirect("/posts/".$post->id);
    }
}