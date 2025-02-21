<header class="bg-blue-500 text-white p-4">
    <h1 class="text-2xl font-bold">{{ $slot }}</h1>
    <nav>
        <ul class="flex space-x-4">
            <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
            <li><a href="{{ url('/about') }}" class="hover:underline">About</a></li>
        </ul>
    </nav>
</header>
