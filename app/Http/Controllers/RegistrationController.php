<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {

        $attributes = request()->validate([      // if input fails validation, store returns
            'name' => 'required|max:140',
            'username' => 'required|min:3|max:140|unique:users,username',
            'email' => 'required|email|max:140|unique:users,email',
            'password' => 'required|min:8|max:20',
            'profile_image' => 'required|image|dimensions:ratio=1/1'
        ]);

        $attributes['profile_image'] = request()->file('profile_image')->store('profile_images');

        $user = User::create($attributes);
        auth()->login($user);
        return redirect('/')->with('success', 'Your account has been created');
    }
}
