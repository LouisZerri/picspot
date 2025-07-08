@extends('layouts.app')

@section('content')

    <div class="min-h-screen gradient-bg relative overflow-hidden">
        <!-- Floating Shapes -->
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        
        <!-- Back Button -->
        <a href="/" class="back-btn flex items-center space-x-2 text-white/80 hover:text-white transition-colors cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>Retour</span>
        </a>

        <!-- Main Content -->
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="glass-card rounded-2xl w-full max-w-md p-8 animate-fade-in">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <div class="flex items-center justify-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                            PicSpot
                        </h1>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Créer un compte</h2>
                    <p class="text-gray-600">Rejoignez la communauté des photographes</p>
                </div>

                <!-- Form -->
                <form class="space-y-4" action="{{ route("register_action")}}" method="POST">
                    @csrf
                    <!-- First Name & Last Name -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="input-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                            <input type="text" 
                                class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                name="firstname"
                                placeholder="Jean"
                                required>
                        </div>
                        <div class="input-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                            <input type="text" 
                                class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                name="lastname"
                                placeholder="Dupont"
                                required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="input-group">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" 
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            name="email"
                            placeholder="jean.dupont@email.com"
                            required>
                    </div>

                    <!-- Password -->
                    <div class="input-group">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                        <div class="relative">
                            <input type="password" 
                                id="password"
                                class="input-field w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                name="password"
                                placeholder="••••••••"
                                required>
                            <button type="button" 
                                    onclick="togglePassword()"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Minimum 8 caractères</p>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="submit-btn w-full py-3 text-white font-medium rounded-lg cursor-pointer">
                        Créer mon compte
                    </button>
                </form>

                <!-- Sign In Link -->
                <div class="text-center mt-6 pt-6 border-t border-gray-200">
                    <p class="text-gray-600">
                        Déjà un compte ? 
                        <a href="{{ route("login") }}" class="text-purple-600 hover:text-purple-500 font-medium">Se connecter</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection