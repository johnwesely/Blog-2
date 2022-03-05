<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index() 
    {
        return view('favorite.index', [
            'favorites' => Favorite::all()
                               ->where('user_id', auth()->user()->id)
        ]);
    }

    public function toggleRead(Favorite $favorite)
    {
        $attributes['read'] = ! $favorite->read;
        $favorite->update($attributes);

        return back()->with('success', 
                            "{$favorite->post->title} marked as ". ($favorite->read ? 'read' : 'unread'));
    }

    public function store(Post $post)
    {

        if (! Favorite::all()
            ->where('user_id', auth()->user()->id)
            ->where('post_id', $post->id) 
            ->isEmpty())
        {
            return back()->with('success', 'This Article is Already a Favorite');
        }

        $post->favorites()->create([
            'user_id' => auth()->user()->id
        ]);

        return back()->with('success', 'This Post Has Been Added to Your Favorites');
    }

    public function destroy(Post $post) 
    {
        $favorite = Favorite::all()
                        ->where('user_id', auth()->user()->id)
                        ->where('post_id', $post->id);

        $favorite->first()->delete();
        return back()->with('success', 'Post Removed From Favorites');
    }

}
