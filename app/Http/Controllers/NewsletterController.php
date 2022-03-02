<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Newsletter;
use Exception;

class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter) 
    {
        request()->validate([
            'email' => 'required|email'
        ]);
    
        try {
            $newsletter = new Newsletter();
            $newsletter->subscribe(request('email'));
        } catch (Exception $e) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list'
            ]);
        }
    
        return redirect('/')->with('success', 'Thank you for subscribing');
    }
}
