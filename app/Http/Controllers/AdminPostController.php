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
            'posts' => Post::paginate(10)
        ]);
    }

    public function edit(Post $post) 
    {
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function create() 
    {
        return view('admin.posts.create');
    }

    public function store() 
    {
        $attributes = request()->validate([
            'title' => 'required|max:140|unique:posts',
            'excerpt' => 'required|max: 1000',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'thumbnail' => 'required|image'
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['slug'] = preg_replace('/\s+/', '', request('title'));
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($attributes);
        return redirect('/')->with('success', 'Post Sucessful');
    }

    public function update(Post $post) {
        $attributes = request()->validate([
            'title' => ['required', 'Max:140', Rule::unique('posts', 'title')->ignore($post->id)],
            'excerpt' => 'required|max: 300',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'thumbnail' => 'image'
        ]);

        $attributes['user_id'] = auth()->id();

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
}
