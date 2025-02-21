<!DOCTYPE html>
<html lang="en">
    
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'To-Do App')</title>
        @vite(['resources/css/app.css'])

    </head>
    
<body>

    <x-header>
        @yield('header', 'Default Header')
    </x-header>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>