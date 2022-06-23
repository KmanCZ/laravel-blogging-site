<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(User $user, Post $post) {
        request()->validate([
            "comment" => ["required", "string"]
        ]);

        Comment::create(["post_id" => $post->id, "user_id" => auth()->id(), "content" => request()->comment]);

        return back();
    }

    public function destroy(Comment $comment) {
        if($comment->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $comment->delete();

        return back();
    }
}