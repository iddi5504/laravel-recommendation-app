<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'username' => ['required', 'unique:users,username', 'max:30'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'confirmed']
        ]);

        if ($validated['email'] === env('ADMIN_EMAIL')) {
            $validated['isAdmin'] = true;
        }

        $validated['avatar'] = config('constants.avatars')[rand(1, 10)];

        User::create($validated);
        return redirect()->route('login')->with('success', 'Account successfully created');
    }
}
