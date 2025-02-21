<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Bibliothèque Saint-Marc</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-[#2C001E] min-h-screen font-sans antialiased">
    <div class="flex flex-col min-h-screen">
        <!-- Navigation Bar -->
        <nav class="bg-[#300a24] p-4 shadow-lg">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="text-white text-xl font-semibold">Bibliothèque Saint-Marc</div>
                <div class="flex items-center gap-4">
                    <span class="text-gray-300">Welcome, {{ Auth::user()?->fullname }}, {{ Auth::user()?->role }}</span>
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
                <h1 class="text-3xl font-bold text-white">Admin Dashboard</h1>
            </header>

            <!-- Grid de cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Gestion des Livres -->
                <div class="bg-[#300a24] rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-white">Gestion des Livres</h3>
                            <button onclick="openBooksModal()" 
                                    class="bg-[#e95420] hover:bg-[#e95420]/90 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Ajouter
                            </button>
                        </div>
                        <p class="text-gray-300 mb-4">Gérez votre collection de livres</p>
                        <ul class="text-gray-300">
                            <li class="flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Ajouter de nouveaux livres
                            </li>
                            <li class="flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Modifier les informations
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Supprimer des livres
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Gestion des Utilisateurs -->
                <div class="bg-[#300a24] rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-white">Gestion des Utilisateurs</h3>
                            <button onclick="openUsersModal()" 
                                    class="bg-[#e95420] hover:bg-[#e95420]/90 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Ajouter
                            </button>
                        </div>
                        <p class="text-gray-300 mb-4">Gérez les comptes utilisateurs</p>
                        <ul class="text-gray-300">
                            <li class="flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Créer des comptes
                            </li>
                            <li class="flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Gérer les permissions
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Désactiver des comptes
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Gestion des Emprunts -->
                <div class="bg-[#300a24] rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-white">Gestion des Emprunts</h3>
                            <button onclick="openLoansModal()" 
                                    class="bg-[#e95420] hover:bg-[#e95420]/90 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Nouveau
                            </button>
                        </div>
                        <p class="text-gray-300 mb-4">Suivez les emprunts de livres</p>
                        <ul class="text-gray-300">
                            <li class="flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Enregistrer les emprunts
                            </li>
                            <li class="flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Gérer les retours
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Suivre les retards
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openBooksModal() {
            // Add your modal opening logic for books
            alert('Ouverture du modal de gestion des livres');
        }

        function openUsersModal() {
            // Add your modal opening logic for users
            alert('Ouverture du modal de gestion des utilisateurs');
        }

        function openLoansModal() {
            // Add your modal opening logic for loans
            alert('Ouverture du modal de gestion des emprunts');
        }
    </script>
</body>
</html>