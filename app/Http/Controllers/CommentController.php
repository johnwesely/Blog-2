<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Post $post)
    {
        // validate
        request()->validate([
            'body' => 'required'
        ]);

        // peform an action
        $post->comments()->create([             // never use a create method without explicitly declaring fields 
            'body' => request('body'),          // with universally unguarded fields
            'user_id' => auth()->user()->id
        ]);

        // redirect 
        return back()->with('success', 'Thank you for your comment');
    }

    public function edit(Comment $comment) 
    {
        if (auth()->user()->id !== $comment->author->id && ! auth()->user()->is_admin) {  // users can only edit their own posts
            abort(403);
        }

        return view('comment.edit', ['comment' => $comment ]);
    }

    public function update(Comment $comment)
    {
        $body = request()->validate([
            'body' => 'required'
        ]);

        $comment->update($body);

        if (auth()->user()->is_admin) {
            return redirect("comment/comments")->with('success', 'Post Successfully Edited');
        }

        return redirect("posts/{$comment->post->slug}")->with('success', 'Post Successfully Edited');
    }

    public function index() {
        return view('comment.index', [
            'comments' => Comment::with('author')->with('post')->get()
        ]);
    }
    
}
