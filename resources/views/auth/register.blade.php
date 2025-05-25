{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.default')

@section('title', 'Register')

@section('content')
<form class="bg-white shadow-md max-w-md rounded-2xl p-8 mx-auto mt-10 space-y-6" action="{{ route('register') }}" method="post">

    @csrf

    <h2 class="text-2xl font-bold text-gray-800 text-center">Register</h2>

    {{-- Username --}}
    <div>
        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
        <input type="text" name="username" id="username" value="{{ old('username') }}" class="input" placeholder="Choose a username">
        @error('username')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Email --}}
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" class="input" placeholder="you@example.com">
        @error('email')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Password --}}
    <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" id="password" class="input" placeholder="Create a password">
        @error('password')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Confirm Password --}}
    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="input" placeholder="Re‑enter your password">
    </div>

    <button type="submit" class="button w-full">
        Register
    </button>

    <p class="text-center text-sm text-gray-600">
        Already have an account?
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login here</a>
    </p>
</form>
@endsection
