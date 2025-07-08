@extends('layouts.app')

@section('content')
    <!-- Header -->
    <header class="glass-effect sticky top-0 z-50 border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="/">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold gradient-text">PicSpot</h1>
                    </div>
                </a>

                <!-- Profile -->
                <div class="flex items-center space-x-3">
                    @auth
                        <span class="px-4 py-2 text-gray-700 font-medium">
                            Bienvenue {{ Auth::user()->firstname }} 👋
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-purple-100 transition-all duration-200 cursor-pointer"
                                title="Déconnexion" type="submit">
                                <!-- Icône logout -->
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                                </svg>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-gray-700 hover:text-purple-600 font-medium transition-colors cursor-pointer">
                            Se connecter
                        </a>
                        <a href="{{ route('register') }}"
                            class="px-6 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full font-medium hover:from-purple-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 cursor-pointer">
                            S'inscrire
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </header>

    <pictures></pictures>

    <footer class="bg-gradient-to-r from-slate-900 via-purple-900 to-slate-900 text-white mt-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">
            <div class="flex items-center justify-center space-x-3 mb-6">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold">PicSpot</h3>
            </div>

            <p class="text-gray-300 leading-relaxed mb-8 max-w-2xl mx-auto">
                Découvrez et partagez les plus beaux lieux de France. Une communauté de photographes passionnés qui
                capturent l'essence de chaque destination, des monuments emblématiques aux trésors cachés.
            </p>

            <div class="border-t border-gray-700 pt-6">
                <p class="text-gray-400 text-sm">
                    © 2025 PicSpot. Tous droits réservés. Fait avec ❤️ pour la communauté des photographes.
                </p>
            </div>
        </div>
    </footer>

    <!-- Floating Action Button -->
    @auth
        <a href="{{ route('photo.create') }}"
            class="floating-btn w-16 h-16 rounded-full text-white shadow-lg flex items-center justify-center z-50 cursor-pointer fixed bottom-8 right-8 bg-gradient-to-br from-purple-500 to-pink-500 hover:scale-110 transition-all duration-300">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </a>
    @else
        <a href="{{ route('login') }}"
            class="floating-btn w-16 h-16 rounded-full text-white shadow-lg flex items-center justify-center z-50 cursor-pointer fixed bottom-8 right-8 bg-gradient-to-br from-purple-500 to-pink-500 hover:scale-110 transition-all duration-300">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </a>
    @endauth
@endsection
