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

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <form action="{{ route('photo.create.action') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Upload d'image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Photo <span class="text-red-500">*</span>
                        </label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-purple-400 transition-colors">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="image"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-purple-500">
                                        <span>Télécharger une image</span>
                                        <input id="image" name="image" type="file" accept="image/*" class="sr-only"
                                            required>
                                    </label>
                                    <p class="pl-1">ou glisser-déposer</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG jusqu'à 5MB</p>
                            </div>
                        </div>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Prévisualisation -->
                    <div id="preview-container" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Prévisualisation</label>
                        <div class="relative">
                            <img id="preview-image" class="max-w-full h-48 object-cover rounded-lg shadow-sm">
                            <button type="button" id="remove-preview"
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Titre -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Titre <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="Donnez un titre à votre photo..." required>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Catégorie -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            Catégorie <span class="text-red-500">*</span>
                        </label>
                        <select id="category" name="category"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            required>
                            <option value="">Sélectionnez une catégorie</option>
                            <option value="Hôtels" {{ old('category') == 'Hôtels' ? 'selected' : '' }}>Hôtels</option>
                            <option value="Restaurants" {{ old('category') == 'Restaurants' ? 'selected' : '' }}>Restaurants
                            </option>
                            <option value="Bars/Cafés" {{ old('category') == 'Bars/Cafés' ? 'selected' : '' }}>Bars/Cafés
                            </option>
                            <option value="Activités" {{ old('category') == 'Activités' ? 'selected' : '' }}>Activités
                            </option>
                            <option value="Immobilier" {{ old('category') == 'Immobilier' ? 'selected' : '' }}>Immobilier
                            </option>
                            <option value="Monuments" {{ old('category') == 'Monuments' ? 'selected' : '' }}>Monuments
                            </option>
                        </select>
                        @error('category')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lieu -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                            Lieu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="Ex: Hôtel Ibis Paris Bastille" required>
                        <p class="mt-1 text-xs text-gray-500">Soyez précis pour aider les autres utilisateurs à trouver ce
                            lieu</p>
                        @error('location')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lien optionnel -->
                    <div>
                        <label for="link" class="block text-sm font-medium text-gray-700 mb-2">
                            Lien (optionnel)
                        </label>
                        <input type="url" id="link" name="link" value="{{ old('link') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="https://example.com">
                        <p class="mt-1 text-xs text-gray-500">Lien vers le site web de l'établissement</p>
                        @error('link')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tags -->
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">
                            Tags (maximum 3)
                        </label>
                        <div class="space-y-2">
                            <div class="flex flex-wrap gap-2" id="tags-container">
                                <!-- Les tags seront ajoutés ici dynamiquement -->
                            </div>
                            <div class="flex">
                                <input type="text" id="tag-input"
                                    class="flex-1 px-3 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                    placeholder="Ajouter un tag..." maxlength="20">
                                <button type="button" id="add-tag-btn"
                                    class="px-4 py-2 bg-purple-500 text-white rounded-r-lg hover:bg-purple-600 transition-colors cursor-pointer">
                                    Ajouter
                                </button>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Utilisez des mots-clés pour décrire votre photo</p>
                        <input type="hidden" name="tags" id="tags-hidden">
                        @error('tags')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Boutons -->
                    <div class="flex justify-between items-center pt-6">
                        <a href="{{ route('home') }}"
                            class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Annuler
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition-colors font-medium cursor-pointer">
                            Publier la photo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
@endsection
