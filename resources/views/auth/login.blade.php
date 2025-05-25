@extends('layouts.default')

@section('title', 'Login')

@section('content')
<form class="bg-white shadow-md max-w-md rounded-2xl p-8  mx-auto mt-10 space-y-6" action="{{ route('login') }}" method="post">
    @csrf

    <h2 class="text-2xl font-bold text-gray-800 text-center">Login</h2>

    @if($errors->any())
    @foreach ($errors->all() as $error )

    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ $error }}</span>
    </div>
    @endforeach
    {{-- @foreach ($errors->all() in $error)

    @endforeach --}}

    @endif

    <div>
        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
        <input type="text" name="username" id="username" value="{{ old('username') }}" class="input" placeholder="Enter your username">

        @if($errors->has('username'))
        <p class="text-sm text-red-600 font-medium">{{ $errors->first('username') }}</p>
        @endif
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" id="password" value="{{ old('password') }}" class="input" placeholder="Enter your password">


        @if($errors->has('password'))
        <p class="text-sm text-red-600 font-medium">{{ $errors->first('password') }}</p>
        @endif

    </div>

    <button type="submit" class="button w-full">
        Login
    </button>

    <p class="text-center text-sm text-gray-600">
        Do not have an account?
        <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register here</a>
    </p>

</form>
@endsection
