<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(User $user, Post $post) {
        request()->validate([
            "comment" => ["required", "string"]
        ]);

        Comment::create(["post_id" => $post->id, "user_id" => auth()->id(), "content" => request()->comment]);

        return back();
    }
}