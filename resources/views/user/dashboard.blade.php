<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Management - Saint-Marc Library</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-[#2C001E] min-h-screen font-sans antialiased">
    <div class="flex flex-col min-h-screen">
        <!-- Navigation Bar -->
        <nav class="bg-[#300a24] p-4 shadow-lg">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="text-white text-xl font-semibold">Saint-Marc Library</div>
                <div class="flex items-center gap-4">
                    <!-- <span class="text-gray-300">Welcome, {{ Auth::user()?->fullname }}, {{ Auth::user()?->role }}</span> -->
                    <form method="POST" action="{{ url('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-[#e95420] hover:bg-[#e95420]/90 text-white rounded-md transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <header class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-white">All Books</h1>
            </header>

            <!-- Books Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($books as $book)
                    <div class="bg-[#300a24] rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="https://media.istockphoto.com/id/1242139791/vector/abstract-open-schoolbook-with-icons-of-school-subjects.jpg?s=612x612&w=0&k=20&c=471L4qYzgwpdcvdFCW_Kc2KwWN3bxNUd-wVGQcUMLpQ=" 
                                 alt="{{ $book->title }}"
                                 class="w-full h-48 object-cover"
                                 onerror="this.src='/api/placeholder/400/320';this.onerror=null;">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-3 text-white">{{ $book->title }}</h3>
                            <div class="space-y-2 text-gray-300">
                                <p>
                                    <span class="font-medium">Status:</span>
                                    @if($book->isAvailable)
                                        <span class="text-green-400">Available</span>
                                    @else
                                        <span class="text-red-400">Borrowed{{ $book->borrowsBY }}</span>
                                    @endif
                                </p>
                                <p>
                                    <span class="font-medium">Category:</span>
                                    {{ $book->category->name }}
                                </p>
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-600">
                                <div class="flex justify-end gap-2">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

<!-- Create Modal -->
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
    <div class="bg-[#300a24] p-8 rounded-xl shadow-lg w-full max-w-2xl mx-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-white">Add a New Book</h2>
            <button onclick="closeCreateModal()" class="text-gray-300 hover:text-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form action="{{ route('books.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-300 font-medium mb-2">Book Title</label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       class="w-full px-4 py-2 bg-[#2C001E] border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#e95420] text-white" 
                       required>
            </div>
            <div class="mb-4">
                <label for="imgURL" class="block text-gray-300 font-medium mb-2">Image URL</label>
                <input type="url" 
                       id="imgURL" 
                       name="imgURL" 
                       class="w-full px-4 py-2 bg-[#2C001E] border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#e95420] text-white" 
                       required>
            </div>
            <div class="mb-4">
                <label for="category_id" class="block text-gray-300 font-medium mb-2">Category</label>
                <select id="category_id" 
                        name="category_id" 
                        class="w-full px-4 py-2 bg-[#2C001E] border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#e95420] text-white" 
                        required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="isAvailable" class="block text-gray-300 font-medium mb-2">Availability</label>
                <select id="isAvailable" 
                        name="isAvailable" 
                        class="w-full px-4 py-2 bg-[#2C001E] border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#e95420] text-white" 
                        required>
                    <option value="1">Available</option>
                    <option value="0">Not Available</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="borrowsBY" class="block text-gray-300 font-medium mb-2">Borrowed By (User ID)</label>
                <input type="number" 
                       id="borrowsBY" 
                       name="borrowsBY" 
                       class="w-full px-4 py-2 bg-[#2C001E] border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#e95420] text-white">
            </div>
            <div class="mb-4">
                <label for="user_id" class="block text-gray-300 font-medium mb-2">Added By (Admin ID)</label>
                <input type="number" 
                       id="user_id" 
                       name="user_id" 
                       value="{{ auth()->id() }}" 
                       class="w-full px-4 py-2 bg-[#2C001E] border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#e95420] text-white" 
                       readonly>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" 
                        onclick="closeCreateModal()" 
                        class="px-6 py-2 border border-gray-600 rounded-lg text-gray-300 hover:bg-gray-700">
                    Cancel
                </button>
                <button type="submit" 
                        class="bg-[#e95420] hover:bg-[#e95420]/90 text-white px-6 py-2 rounded-lg">
                    Add Book
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
    <div class="bg-[#300a24] p-8 rounded-xl shadow-lg w-full max-w-2xl mx-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-white">Edit Book</h2>
            <button onclick="closeEditModal()" class="text-gray-300 hover:text-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="editForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="edit_title" class="block text-gray-300 font-medium mb-2">Book Title</label>
                <input type="text" 
                    id="edit_title" 
                    name="title" 
                    class="w-full px-4 py-2 bg-[#2C001E] border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#e95420] text-white" 
                    required>
            </div>
            <div class="mb-4">
                <label for="edit_imgURL" class="block text-gray-300 font-medium mb-2">Image URL</label>
                <input type="url" 
                    id="edit_imgURL" 
                    name="imgURL" 
                    class="w-full px-4 py-2 bg-[#2C001E] border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#e95420] text-white" 
                    required>
            </div>
            <div class="mb-4">
                <label for="edit_category_id" class="block text-gray-300 font-medium mb-2">Category</label>
                <select id="edit_category_id" 
                        name="category_id" 
                        class="w-full px-4 py-2 bg-[#2C001E] border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#e95420] text-white" 
                        required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="edit_isAvailable" class="block text-gray-300 font-medium mb-2">Availability</label>
                <select id="edit_isAvailable" 
                        name="isAvailable" 
                        class="w-full px-4 py-2 bg-[#2C001E] border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#e95420] text-white" 
                        required>
                    <option value="1">Available</option>
                    <option value="0">Not Available</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="edit_borrowsBY" class="block text-gray-300 font-medium mb-2">Borrowed By (User ID)</label>
                <input type="number" 
                       id="edit_borrowsBY" 
                       name="borrowsBY" 
                       class="w-full px-4 py-2 bg-[#2C001E] border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#e95420] text-white">
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" 
                        onclick="closeEditModal()" 
                        class="px-6 py-2 border border-gray-600 rounded-lg text-gray-300 hover:bg-gray-700">
                    Cancel
                </button>
                <button type="submit" 
                        class="bg-[#e95420] hover:bg-[#e95420]/90 text-white px-6 py-2 rounded-lg">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>


    </div>

</body>
</html>
