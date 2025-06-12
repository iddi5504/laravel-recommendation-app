@php
$postRoute = isset($recommendation) ? 'recommendation.update' : 'recommendation.store';
@endphp

<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-2xl shadow-md">

    {{-- {{ dd($recommendation) }} --}}

    {{-- Title --}}
    <h2 class="text-2xl font-bold mb-6">{{ $title }}</h2>

    {{-- Show validation errors --}}
    @if ($errors->any())
    <div class="mb-4 text-red-600">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route($postRoute, compact('recommendation')) }}" enctype="multipart/form-data" method="post">

        @method($method ?? 'POST')
        @csrf

        <div class="mb-4">
            <label for="title" class="block font-semibold">Title</label>
            <input type="text" name="title" id="title" value="{{ $recommendation->title ??  old('title') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"" required>
        </div>

        <div class=" mb-4">
            <label for="description" class="block font-semibold">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"" required>{{  $recommendation->description ?? old('description') }}</textarea>

        </div>

        <div class=" mb-4">
            <label for="rating" class="block font-semibold">Rating</label>
            <input type="number" name="rating" id="rating" value="{{ $recommendation->rating ?? old('rating') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"" min=" 1" max="5" required>

        </div>
        <div class=" mb-4">
            <label for="rating" class="block font-semibold">Image</label>
            <input type="file" name="imagePath" id="image" onChange="handleImage" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"" min=" 1" max="5" accept="image/*" {{ strtolower($method) === 'post' ? 'required' : '' }}>


        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Submit</button>
    </form>
</div>
