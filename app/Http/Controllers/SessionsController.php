<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    /**
     * @throws ValidationException
     */
    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (! auth()->attempt($attributes)){
            throw ValidationException::withMessages([
                'email' => 'your provided credentials could not be verified'
            ]);
        }
        session()->regenerate();

        return redirect('/')->with('success', 'welcome back');

    }

    public function destroy(){
        auth()->logout();
        return redirect ('/')->with('success', 'Goodbye!');
    }
}
