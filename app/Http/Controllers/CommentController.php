<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

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
    
}
