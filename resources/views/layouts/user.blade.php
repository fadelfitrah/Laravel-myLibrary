<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="absolute inset-[-1] bg-black opacity-10 z-[-1]">
        <img src="{{ asset('background2.jpeg') }}" alt="Background Image" class="fixed inset-0 object-cover w-full h-full opacity-100 z-[-1]">
    </div>
    @guest
    <header>
        @include('components.guest_navbar')
    </header>
    @else
    <header>
        @include('components.user_navbar', ['user' => auth()->user()])
    </header>
      
    @endguest
    <div class="container mx-auto py-4">
        @yield('content')
    </div>
    
    <x-footer />
</body>
</html>