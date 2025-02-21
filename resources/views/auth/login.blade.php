<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<!-- resources/views/auth/login.blade.php -->
<body class="bg-[#2C001E] min-h-screen flex items-center justify-center font-sans antialiased">
    <div class="bg-[#300a24] p-10 rounded-lg shadow-xl w-full max-w-md text-white">
    <a href="/register" class="text-base text-[#e95420] hover:text-[#e95420]/80">Register</a>
        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST" class="space-y-8">
            @csrf
            <div>
                <label for="email" class="block text-base font-medium text-gray-300 mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md bg-[#3d1336] border-[#e95420] p-4 text-white placeholder-gray-400 shadow-sm focus:border-[#e95420] focus:ring focus:ring-[#e95420]/50" required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-base font-medium text-gray-300 mb-2">Password</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full rounded-md bg-[#3d1336] border-[#e95420] p-4 text-white placeholder-gray-400 shadow-sm focus:border-[#e95420] focus:ring focus:ring-[#e95420]/50" required>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center justify-between py-2">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" class="h-5 w-5 text-[#e95420] focus:ring-[#e95420] border-gray-600 rounded bg-[#3d1336]">
                    <label class="ml-3 block text-base text-gray-300">Remember me</label>
                </div>
                <a href="" class="text-base text-[#e95420] hover:text-[#e95420]/80">Forgot password?</a>
            </div>
            <button type="submit" class="w-full flex justify-center py-4 px-6 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-[#e95420] hover:bg-[#e95420]/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#e95420]">
                Sign in
            </button>
        </form>
    </div>
</body>
