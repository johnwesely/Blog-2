<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Post;

class AdminPostController extends Controller
{
    public function index() 
    {
        return view('admin.posts.index', [
            'posts' => Post::all()
        ]);
    }
    
    public function create() 
    {
        return view('admin.posts.create');
    }

    public function store() 
    {
        $attributes = request()->validate([
            'title' => 'required|max:140|unique:posts',
            'excerpt' => 'required|max: 3000',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'thumbnail' => 'required|image|dimensions:ratio=1/1'
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['slug'] = preg_replace('/\s+/', '', request('title'));
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        $attributes['published'] = ! request()->input('save_as_draft');

        Post::create($attributes);
        return redirect('/')->with('success', 'Post Sucessful');
    }

    public function edit(Post $post) 
    {
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post) 
    {
        $attributes = request()->validate([
            'title' => ['required', 'Max:140', Rule::unique('posts', 'title')->ignore($post->id)],
            'excerpt' => 'required|max: 3000',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'thumbnail' => 'image|dimensions:ratio=1/1'
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['published'] = ! request()->input('save_as_draft');

        if (isset($attributes['thumbnail'])) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'Post Successfully Updated!');
    }

       public function destroy(Post $post) {
        $post->delete();
        return back()->with('success', 'Down the Memory Hole is Goes');
    }

    public function togglePublished(Post $post) {
        $attributes['published'] = ! $post->published;
        $post->update($attributes);

        return back()->with('success', "Post " . ($post->published ? 'Published' : 'Unpublished'));
    }

}
