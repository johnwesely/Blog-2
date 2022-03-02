<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function create() 
    {
        return view('sessions.create');
    }

    public function destroy() 
    {
        $user = auth()->user()->name;
        auth()->logout();

        return redirect('/')->with('success', "Goodbye, $user");
    }

    public function store()
    {
        $attributes = request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt($attributes)) {
            session()->regenerate();
            $username = auth()->user()->name;
            return redirect('/')
                ->with('success', "Welcome Back, {$username}!");
        }

        return back()
            ->withInput()
            ->withErrors(['username' => 'Your provided username and password do not match our records']);
    }

}
