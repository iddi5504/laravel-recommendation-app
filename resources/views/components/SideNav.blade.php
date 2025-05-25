<aside class="w-64 bg-white shadow-lg flex flex-col justify-between">
    <div>
        <!-- Logo or Brand -->
        <div class="p-6 border-b">
            <h1 class="text-xl font-bold text-gray-700">My Dashboard</h1>
        </div>

        <!-- Navigation -->
        <nav class="mt-4 space-y-2 px-6">
            <a href="/dashboard" class="block py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100">Dashboard</a>
            <a href="/projects" class="block py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100">Projects</a>
            <a href="{{ route('recommendations.index') }}" class="block py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100">Recommendations</a>
            <a href="{{ route('settings') }}" class="block py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100">Settings</a>
        </nav>
    </div>

    <!-- User Info & Logout -->
    <div class="p-6 border-t">
        <div class="flex items-center space-x-3 mb-4">
            <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="w-10 h-10 rounded-full">


            <div>
                <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->username }}</p>
                <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full py-2 px-4 bg-red-500 text-white text-sm rounded-md hover:bg-red-600">
                Logout
            </button>
        </form>
    </div>
</aside>
