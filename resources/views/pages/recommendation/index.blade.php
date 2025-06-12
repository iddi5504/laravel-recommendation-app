@extends('layouts.app')

@section('dashbord-content')

<div class="max-w-7xl mx-auto py-10 px-4">
    <div class="flex justify-between">
        <h1 class="text-3xl font-bold mb-8">Recommendations</h1>
        <a class="button" href="{{ route('recommendations.create') }}">
            Add
        </a>

    </div>

    @if (session('success'))
    <div class="mb-6 p-4 pt-1 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif

    @if ($recommendations->isEmpty())
    <p class="text-gray-600">No recommendations yet.</p>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($recommendations as $recommendation)
        <div class="bg-white shadow rounded-xl p-6 hover:shadow-lg transition">
            <img src="{{ '/storage/' . $recommendation->imagePath }}" class="w-full h-60 object-cover" alt="">

            <a href="{{ route('recommendation.show', $recommendation) }}">
                <h2 class="text-xl font-semibold mb-2">{{ $recommendation->title }}</h2>
            </a>
            <p class="text-gray-700 mb-4">{{ $recommendation->description }}</p>

            <div class="flex items-center justify-between text-sm text-gray-600">
                <span><strong>Rating:</strong> {{ $recommendation->rating }}/5</span>
                <div class="flex gap-1">
                    {{-- avatar --}}
                    <img src="{{ $recommendation->user->avatar }}" alt="{{ $recommendation->user->username }}" class="w-8 h-8 rounded-full inline-block mr-2">
                    <span>{{ $recommendation->user->username }}</span>
                </div>
            </div>

            <div class="text-right mt-4">
                <span class="text-xs text-gray-400">{{ $recommendation->created_at->diffForHumans() }}</span>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
