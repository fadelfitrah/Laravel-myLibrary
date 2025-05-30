<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        @if (session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="mb-4 text-red-600 text-center">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('login.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="email" name="email" placeholder="Email" required class="w-full px-3 py-2 border rounded" />
            <input type="password" name="password" placeholder="Password" required class="w-full px-3 py-2 border rounded" />
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Login</button>
        </form>
        <p class="mt-4 text-center text-sm">Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a></p>
    </div>
</body>
</html>