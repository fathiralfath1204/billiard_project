<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin - Billiard Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
            <h1 class="text-2xl font-bold text-center mb-6">Login Admin</h1>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1 font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded-lg px-3 py-2" required autofocus>
                </div>

                <div class="mb-6">
                    <label class="block mb-1 font-medium">Password</label>
                    <input type="password" name="password" class="w-full border rounded-lg px-3 py-2" required>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-medium">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>