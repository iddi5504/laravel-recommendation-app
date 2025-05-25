<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateUserController extends Controller
{
    public function loginUser(Request $request)
    {
        $validated =   $request->validate([
            'password' => ['required'],
            'username' => ['required']
        ]);


        $success =  Auth::attempt($validated);

        if ($success) {

            $request->session()->regenerate();

            return redirect()->intended(route('home'))->with('success', "Successfully logged in as {$validated['username']}");
        }


        return back()->withErrors([
            'email' => 'Invalid email or password'
        ]);
    }

    public function logout(Request $request)
    {

        Auth::logout();

        return to_route('login')->with('success', 'You have been logged out');
    }
}
