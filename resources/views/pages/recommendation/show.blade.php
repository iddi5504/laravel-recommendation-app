@extends('layouts.app')

@section('dashbord-content')

<div class="max-w-3xl mx-auto py-10 px-4">
    {{-- Recommendation Card --}}
    <div class="bg-white shadow rounded-xl p-6 mb-8 relative">

        <img src="{{ '/storage/' . $recommendation->imagePath }}" class="w-full h-80 object-contain mb-3" alt="">


        <h1 class="text-3xl font-bold mb-2">{{ $recommendation->title }}</h1>
        <p class="text-gray-600 mb-4">{{ $recommendation->description }}</p>

        <div class="flex justify-between text-sm text-gray-500">
            <span><strong>Rating:</strong> {{$recommendation->rating}}/5</span>
            <span><strong>Author:</strong> {{ $recommendation->user->username }}</span>
            <span><strong>Posted:</strong> {{ $recommendation->created_at }}</span>
        </div>
    </div>


    @can(['update', 'delete'], $recommendation)
    <div class="flex justify-start gap-4 bg-white rounded-xl p-5 shadow-lg mb-6">
        <form class="" action="{{ route('recommendation.destroy', compact('recommendation')) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">
                <span class="mdi mdi-delete-empty text-red-500 text-lg cursor-pointer">Delete</span>
            </button>

        </form>
        <form class="" action="{{ route('recommendation.edit', compact('recommendation')) }}" method="get">
            @csrf
            <button type="submit">
                <span class="text-blue text-lg cursor-pointer">Edit</span>
            </button>

        </form>

    </div>
    @endcan

    {{-- Comment Section --}}
    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-2xl font-semibold mb-4">Comments ({{ count($comments) }})</h2>

        {{-- Comments List --}}
        <div class="space-y-6">
            @foreach ($comments as $comment)
            <div class="border-b pb-4 relative">
                <div class="flex justify-between">
                    <p class="font-semibold">{{ $comment->user->username }}</p>
                    <span class="text-sm text-gray-400">{{ $comment->created_at }}</span>
                </div>
                <p class="text-gray-700 mt-1">{{ $comment->content }}</p>

                <form class="absolute bottom-1 right-1" action="{{ route('comment.destroy', compact('recommendation', 'comment')) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                        <span class="mdi mdi-delete-empty text-red-500 text-lg cursor-pointer"></span>
                    </button>
                </form>

            </div>
            @endforeach
        </div>

        {{-- Add New Comment --}}

        @if($errors->any())
        @foreach ($errors->all() as $error)
        <div class="text-red-500 mt-2">
            {{ $error }}
        </div>
        @endforeach
        @endif

        <form action="{{ route('comment.store', $recommendation) }}" method="POST" class="mt-6">
            @csrf
            <div class="mb-4">
                <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">Add a comment</label>
                <textarea id="comment" name="content" rows="4" class="input"></textarea>

            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Post Comment</button>
        </form>
    </div>
</div>
@endsection
