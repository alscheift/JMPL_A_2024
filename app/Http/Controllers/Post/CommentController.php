<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Post $post): RedirectResponse
    {
        $request = request()->validate([
            'body' => ['required', 'max:255']
        ]);

        $user = auth()->user(); // Get the authenticated user

        $comment = new Comment();
        $comment->user_id = $user->id; 
        $comment->body = $request['body']; 

        $post->comments()->save($comment);

        return back();
    }
}
