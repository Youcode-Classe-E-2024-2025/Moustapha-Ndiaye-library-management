<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Bibliothèque Saint-Marc</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#2C001E] min-h-screen font-sans antialiased">
    <div class="flex flex-col min-h-screen">
        <!-- Navigation Bar -->
        <nav class="bg-[#300a24] p-4 shadow-lg">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="text-white text-xl font-semibold">Bibliothèque Saint-Marc</div>
                <div class="flex items-center gap-4">
                    <span class="text-gray-300">Welcome, {{ Auth::user()?->fullname }}, {{ Auth::user()?->role }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-[#e95420] hover:bg-[#e95420]/90 text-white rounded-md transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="max-w-7xl mx-auto">
                <div class="bg-[#300a24] rounded-lg shadow-xl p-6 text-white">
                    <h1 class="text-2xl font-bold mb-6">User Dashboard</h1>
                    
                    <!-- User Features -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <a href="#" class="block p-6 bg-[#3d1336] rounded-lg hover:bg-[#3d1336]/80 transition">
                            <h2 class="text-xl font-semibold mb-2">Browse Books</h2>
                            <p class="text-gray-300">View available books in the library</p>
                        </a>
                        
                        <a href="#" class="block p-6 bg-[#3d1336] rounded-lg hover:bg-[#3d1336]/80 transition">
                            <h2 class="text-xl font-semibold mb-2">My Loans</h2>
                            <p class="text-gray-300">View your current and past book loans</p>
                        </a>
                        
                        <a href="#" class="block p-6 bg-[#3d1336] rounded-lg hover:bg-[#3d1336]/80 transition">
                            <h2 class="text-xl font-semibold mb-2">My Profile</h2>
                            <p class="text-gray-300">View and update your profile information</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>