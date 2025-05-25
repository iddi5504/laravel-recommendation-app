@extends('layouts.default')

@section('title', 'App')

@section('content')

<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    @include('components.SideNav')

    <!-- Main content -->
    <main class="flex-1 p-8 overflow-y-auto">
        @yield('dashbord-content')
    </main>
</div>


@endsection
