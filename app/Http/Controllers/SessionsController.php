<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }
    public function store()
    {
        $attributes = request()->validate([

            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(auth()->attempt($attributes)){
            //auth failed
//        return back()->withInput()->withErrors([
//            'email'=> "The email or password you entered doesn't match our records. Please double-check and try again"
//        ]);

            throw ValidationException::withMessages([
                'email'=> "The email or password you entered doesn't match our records. Please double-check and try again"
            ]);

        }
        //session fixation
        session()->regenerate();
        //redirect with success flash message
        return redirect('/')
            ->with('success','Welcome Back');


    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success','Goodbye');
    }
}
