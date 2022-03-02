<?php
// handles calling views for homepage and individual post pages

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            // variables available inside view
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))    // all posts or all posts meeting search criteria 
                ->paginate(5)->withQueryString()
        ]);
    }

    public function show(Post $post) 
    {
        return view('posts.show', [
            'post' => $post    // make $post variable available to view
        ]);
    }

    

}