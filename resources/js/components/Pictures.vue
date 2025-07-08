<template>
    <section class="py-8 bg-white/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Filtrer par catégorie</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <div v-for="cat in categories" :key="cat.value" @click="handleCategoryClick(cat.value)"
                    class="category-chip text-white p-4 rounded-xl cursor-pointer transform hover:scale-105 transition-all duration-300"
                    :class="[cat.gradient, getCategoryActiveClass(cat.value)]">
                    <h3 class="font-semibold">{{ cat.label }}</h3>
                    <p class="text-sm opacity-90">{{ cat.desc }}</p>
                </div>
            </div>

            <!-- Sous-menu des communes -->
            <div v-if="showCommunesMenu" class="mt-6 p-6 bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Sélectionnez une commune</h3>
                    <button @click="closeCommunesMenu" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                    <button v-for="commune in communes" :key="commune.value" @click="selectCommune(commune.value)"
                        class="p-3 rounded-lg border-2 text-left transition-all duration-200 hover:shadow-md" :class="selectedCommune === commune.value
                            ? 'border-purple-500 bg-purple-50 text-purple-700'
                            : 'border-gray-200 hover:border-purple-300 text-gray-700'">
                        <div class="font-medium">{{ commune.label }}</div>
                        <div class="text-sm opacity-75">{{ commune.region }}</div>
                    </button>
                </div>

                <div class="mt-4 flex justify-center">
                    <button @click="selectCommune('all')"
                        class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        Toutes les communes
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Barre de recherche -->
    <section class="py-6 bg-gray-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative max-w-2xl mx-auto">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input v-model="searchQuery" @input="handleSearch" type="text"
                        placeholder="Rechercher par titre, lieu, catégorie, tags..."
                        class="block w-full pl-10 pr-12 py-4 border border-gray-300 rounded-full leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-900 shadow-sm">
                    <!-- Bouton clear -->
                    <div v-if="searchQuery" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button @click="clearSearch"
                            class="text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600 transition-colors">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Indicateur de résultats -->
                <div v-if="searchQuery && !loading" class="mt-3 text-center">
                    <p class="text-sm text-gray-600">
                        <span v-if="photos.length > 0">
                            {{ photos.length }} résultat{{ photos.length > 1 ? 's' : '' }} pour
                            <span class="font-medium text-purple-600">"{{ searchQuery }}"</span>
                        </span>
                        <span v-else class="text-gray-500">
                            Aucun résultat pour <span class="font-medium">"{{ searchQuery }}"</span>
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-4">
                    <h2 class="text-3xl font-bold text-gray-900">Photos à la une</h2>
                    <!-- Affichage du filtre actuel -->
                    <div v-if="selectedCommune && selectedCommune !== 'all'" class="flex items-center space-x-2">
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                            📍 {{communes.find(c => c.value === selectedCommune)?.label}}
                        </span>
                        <button @click="closeCommunesMenu" class="text-gray-500 hover:text-gray-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <button
                        class="px-4 py-2 bg-purple-100 text-purple-700 rounded-full font-medium hover:bg-purple-200 transition-colors cursor-pointer"
                        :class="{ 'ring-2 ring-purple-500 bg-purple-200': sortBy === 'likes' }"
                        @click="sortPhotos('likes')">
                        Les plus likées
                    </button>
                    <button
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full font-medium hover:bg-gray-200 transition-colors cursor-pointer"
                        :class="{ 'ring-2 ring-gray-500 bg-gray-200': sortBy === 'recent' }"
                        @click="sortPhotos('recent')">
                        Récentes
                    </button>
                </div>
            </div>

            <div v-if="loading" class="text-center py-12">
                <div class="inline-flex items-center space-x-2">
                    <svg class="animate-spin h-5 w-5 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span class="text-purple-600 font-medium">Chargement...</span>
                </div>
            </div>
            <div v-else-if="photos.length === 0" class="text-center text-gray-500 py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-lg font-medium">Aucune photo pour cette catégorie</p>
            </div>
            <div v-else class="photo-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <div v-for="photo in paginatedPhotos" :key="photo.id"
                    class="photo-card bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 cursor-pointer"
                    @click="openImageModal(photo)">
                    <div class="relative">
                        <img :src="photo.image_path" :alt="photo.category + ' - ' + photo.location"
                            class="h-48 w-full object-cover" />
                        <!-- Badge catégorie -->
                        <div class="absolute top-3 left-3">
                            <span :class="getCategoryBadgeClass(photo.category)"
                                class="px-3 py-1 text-xs font-semibold rounded-full">
                                {{ photo.category }}
                            </span>
                        </div>
                        <!-- Bouton like interactif -->
                        <div class="absolute top-3 right-3">
                            <button @click.stop="toggleLike(photo)" :disabled="photo.isLiking"
                                class="bg-white/90 backdrop-blur-sm rounded-full p-2 shadow-lg hover:bg-white transition-all duration-300 transform hover:scale-110 group"
                                :class="{ 'bg-red-50 ring-2 ring-red-200': photo.isLiked }"
                                :title="isAuthenticated ? (photo.isLiked ? 'Retirer le like' : 'Aimer cette photo') : 'Connectez-vous pour aimer'">
                                <div class="flex items-center space-x-1">
                                    <!-- Animation du cœur -->
                                    <svg class="w-4 h-4 transition-all duration-300"
                                        :class="photo.isLiked ? 'text-red-500 scale-110' : (isAuthenticated ? 'text-gray-400 group-hover:text-red-400' : 'text-gray-300')"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z">
                                        </path>
                                    </svg>
                                    <span class="text-sm font-bold transition-all duration-300"
                                        :class="photo.isLiked ? 'text-red-600' : (isAuthenticated ? 'text-gray-600' : 'text-gray-400')">
                                        {{ photo.likes_count }}
                                    </span>
                                </div>
                                <!-- Icône de cadenas pour les non-connectés -->
                                <svg v-if="!isAuthenticated"
                                    class="w-3 h-3 absolute -top-1 -right-1 text-gray-400 bg-white rounded-full p-0.5"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <!-- Loader pendant le like -->
                                <div v-if="photo.isLiking"
                                    class="absolute inset-0 flex items-center justify-center bg-white/80 rounded-full">
                                    <svg class="w-3 h-3 animate-spin text-red-500" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <!-- Titre -->
                        <h3 class="font-bold text-gray-900 mb-2 text-lg leading-tight">
                            {{ photo.title }}
                        </h3>
                        <!-- Localisation -->
                        <div class="flex items-center text-gray-600 mb-4">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-sm">{{ photo.location }}</span>
                        </div>
                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2">
                            <span v-for="(tag, index) in JSON.parse(photo.tags || '[]')" :key="tag"
                                :class="getTagColor(index)" class="px-3 py-1 text-xs font-medium rounded-full">
                                {{ tag }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div v-if="photos.length > photosPerPage" class="flex justify-center items-center mt-12 space-x-2">
                <!-- Bouton précédent -->
                <button @click="changePage(currentPage - 1)" :disabled="currentPage === 1"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>

                <!-- Numéros de page -->
                <div class="flex space-x-1">
                    <button v-for="page in displayedPages" :key="page" @click="changePage(page)"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-colors cursor-pointer" :class="page === currentPage
                            ? 'bg-purple-500 text-white shadow-lg cursor-pointer'
                            : 'text-gray-700 hover:bg-gray-100 border border-gray-300 cursor-pointer'">
                        {{ page }}
                    </button>
                </div>

                <!-- Bouton suivant -->
                <button @click="changePage(currentPage + 1)" :disabled="currentPage === totalPages"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Informations sur la pagination -->
            <div v-if="photos.length > 0" class="text-center mt-6 text-gray-600">
                <p class="text-sm">
                    Affichage de {{ ((currentPage - 1) * photosPerPage) + 1 }} à {{ Math.min(currentPage *
                        photosPerPage, photos.length) }}
                    sur {{ photos.length }} photo{{ photos.length > 1 ? 's' : '' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Modal pour afficher l'image en grand -->
    <div v-if="showImageModal" class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 p-4"
        @click="closeImageModal" @keydown.esc="closeImageModal">
        <div class="relative max-w-7xl max-h-full w-full h-full flex items-center justify-center">
            <!-- Bouton fermer -->
            <button @click="closeImageModal"
                class="absolute top-4 right-4 z-10 bg-white/20 hover:bg-white/30 rounded-full p-2 text-white transition-all duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <!-- Image -->
            <img :src="selectedPhoto?.image_path" :alt="selectedPhoto?.title"
                class="max-w-full max-h-full object-contain rounded-lg shadow-2xl" @click.stop="">

            <!-- Informations de l'image -->
            <div class="absolute bottom-4 left-4 right-4 bg-black/70 backdrop-blur-sm rounded-lg p-4 text-white">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-xl font-bold mb-2">{{ selectedPhoto?.title }}</h3>
                        <div class="flex items-center text-sm text-gray-300 mb-3">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>{{ selectedPhoto?.location }}</span>
                            <span class="mx-2">•</span>
                            <span :class="getCategoryBadgeClass(selectedPhoto?.category)"
                                class="px-2 py-1 text-xs font-semibold rounded-full">
                                {{ selectedPhoto?.category }}
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="(tag, index) in JSON.parse(selectedPhoto?.tags || '[]')" :key="tag"
                                class="px-2 py-1 text-xs bg-white/20 text-white rounded-full">
                                {{ tag }}
                            </span>
                        </div>
                    </div>
                    <div class="ml-4 flex items-center">
                        <button @click.stop="toggleLike(selectedPhoto)" :disabled="selectedPhoto?.isLiking"
                            class="bg-white/20 hover:bg-white/30 rounded-full p-2 transition-all duration-200 flex items-center space-x-2">
                            <svg class="w-5 h-5" :class="selectedPhoto?.isLiked ? 'text-red-400' : 'text-white'"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z">
                                </path>
                            </svg>
                            <span class="text-sm font-medium">{{ selectedPhoto?.likes_count }}</span>
                        </button>
                        <a v-if="selectedPhoto?.link" :href="selectedPhoto.link" target="_blank"
                            class="ml-3 bg-white/20 hover:bg-white/30 rounded-full p-2 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import { useAuth } from "../composables/useAuth";
import { showToast } from "../utils/toast";

const { isAuthenticated, fetchUser, redirectToLogin } = useAuth();

const photos = ref([]);
const loading = ref(true);
const sortBy = ref('likes');
const selectedCategory = ref('all');
const selectedCommune = ref('');
const showCommunesMenu = ref(false);
const searchQuery = ref('');

// Variables pour le modal d'image
const showImageModal = ref(false);
const selectedPhoto = ref(null);

// Variables de pagination
const currentPage = ref(1);
const photosPerPage = 8;

// Liste des communes principales
const communes = [
    { value: 'paris', label: 'Paris', region: 'Île-de-France' },
    { value: 'lyon', label: 'Lyon', region: 'Auvergne-Rhône-Alpes' },
    { value: 'marseille', label: 'Marseille', region: 'Provence-Alpes-Côte d\'Azur' },
    { value: 'toulouse', label: 'Toulouse', region: 'Occitanie' },
    { value: 'nice', label: 'Nice', region: 'Provence-Alpes-Côte d\'Azur' },
    { value: 'nantes', label: 'Nantes', region: 'Pays de la Loire' },
    { value: 'strasbourg', label: 'Strasbourg', region: 'Grand Est' },
    { value: 'montpellier', label: 'Montpellier', region: 'Occitanie' },
    { value: 'bordeaux', label: 'Bordeaux', region: 'Nouvelle-Aquitaine' },
    { value: 'lille', label: 'Lille', region: 'Hauts-de-France' },
    { value: 'rennes', label: 'Rennes', region: 'Bretagne' },
    { value: 'reims', label: 'Reims', region: 'Grand Est' },
    { value: 'saint-etienne', label: 'Saint-Étienne', region: 'Auvergne-Rhône-Alpes' },
    { value: 'toulon', label: 'Toulon', region: 'Provence-Alpes-Côte d\'Azur' },
    { value: 'grenoble', label: 'Grenoble', region: 'Auvergne-Rhône-Alpes' },
    { value: 'dijon', label: 'Dijon', region: 'Bourgogne-Franche-Comté' }
];

// Computed properties pour la pagination
const totalPages = computed(() => Math.ceil(photos.value.length / photosPerPage));

const paginatedPhotos = computed(() => {
    const start = (currentPage.value - 1) * photosPerPage;
    const end = start + photosPerPage;
    return photos.value.slice(start, end);
});

const displayedPages = computed(() => {
    const pages = [];
    const total = totalPages.value;
    const current = currentPage.value;

    // Afficher jusqu'à 5 pages autour de la page courante
    let startPage = Math.max(1, current - 2);
    let endPage = Math.min(total, current + 2);

    // Ajuster si on est près du début ou de la fin
    if (endPage - startPage < 4) {
        if (startPage === 1) {
            endPage = Math.min(total, startPage + 4);
        } else if (endPage === total) {
            startPage = Math.max(1, endPage - 4);
        }
    }

    for (let i = startPage; i <= endPage; i++) {
        pages.push(i);
    }

    return pages;
});

const categories = [
    {
        value: "communes",
        label: "Principales communes",
        desc: "Paris, Lyon, Marseille...",
        gradient: "bg-gradient-to-r from-blue-500 to-purple-600",
    },
    {
        value: "Hôtels",
        label: "Hôtels",
        desc: "Hébergements",
        gradient: "bg-gradient-to-r from-green-500 to-teal-600",
    },
    {
        value: "Restaurants",
        label: "Restaurants",
        desc: "Gastronomie",
        gradient: "bg-gradient-to-r from-red-500 to-pink-600",
    },
    {
        value: "Bars/Cafés",
        label: "Bars/Cafés",
        desc: "Sorties",
        gradient: "bg-gradient-to-r from-yellow-500 to-orange-600",
    },
    {
        value: "Activités",
        label: "Activités",
        desc: "Loisirs",
        gradient: "bg-gradient-to-r from-indigo-500 to-purple-600",
    },
    {
        value: "Immobilier",
        label: "Immobilier",
        desc: "Logements",
        gradient: "bg-gradient-to-r from-cyan-500 to-blue-600",
    },
];

// Fonction pour obtenir des couleurs de tags variées
const getTagColor = (index) => {
    const colors = [
        'bg-blue-100 text-blue-700',
        'bg-green-100 text-green-700',
        'bg-purple-100 text-purple-700',
        'bg-pink-100 text-pink-700',
        'bg-yellow-100 text-yellow-700',
        'bg-indigo-100 text-indigo-700',
        'bg-red-100 text-red-700',
        'bg-teal-100 text-teal-700',
        'bg-orange-100 text-orange-700',
    ];
    return colors[index % colors.length];
};

// Fonction pour obtenir la classe CSS du badge de catégorie
const getCategoryBadgeClass = (category) => {
    const badgeClasses = {
        'Monuments': 'bg-purple-500 text-white',
        'Restaurants': 'bg-red-500 text-white',
        'Hôtels': 'bg-green-500 text-white',
        'Bars/Cafés': 'bg-yellow-500 text-white',
        'Activités': 'bg-indigo-500 text-white',
        'Immobilier': 'bg-cyan-500 text-white',
    };
    return badgeClasses[category] || 'bg-gray-500 text-white';
};

// Fonction pour déterminer si une catégorie est active
const getCategoryActiveClass = (categoryValue) => {
    // Si une commune est sélectionnée, seule la catégorie "communes" doit être active
    if (selectedCommune.value && selectedCommune.value !== 'all') {
        return categoryValue === 'communes' ? 'ring-4 ring-purple-300 scale-105' : '';
    }
    // Sinon, vérifier si la catégorie correspond à la sélection actuelle
    return selectedCategory.value === categoryValue ? 'ring-4 ring-purple-300 scale-105' : '';
};

// Fonction pour gérer la recherche
const handleSearch = () => {
    // Petite pause pour éviter trop de requêtes
    clearTimeout(window.searchTimeout);
    window.searchTimeout = setTimeout(() => {
        fetchPhotos();
    }, 300);
};

// Fonction pour vider la recherche
const clearSearch = () => {
    searchQuery.value = '';
    fetchPhotos();
};

// Fonction pour ouvrir le modal d'image
const openImageModal = (photo) => {
    selectedPhoto.value = photo;
    showImageModal.value = true;
    // Empêcher le scroll de la page
    document.body.style.overflow = 'hidden';
};

// Fonction pour fermer le modal d'image
const closeImageModal = () => {
    showImageModal.value = false;
    selectedPhoto.value = null;
    // Réactiver le scroll de la page
    document.body.style.overflow = 'auto';
};

// Fonction pour gérer le clic sur une catégorie
const handleCategoryClick = (category) => {
    if (category === 'communes') {
        showCommunesMenu.value = !showCommunesMenu.value;
        // Si on ferme le menu, on reset les filtres
        if (!showCommunesMenu.value) {
            selectedCommune.value = '';
            selectedCategory.value = 'all';
            fetchPhotos();
        }
    } else {
        // Fermer le menu des communes si ouvert
        showCommunesMenu.value = false;
        selectedCommune.value = '';
        selectCategory(category);
    }
};

// Fonction pour sélectionner une commune
const selectCommune = (commune) => {
    selectedCommune.value = commune;
    showCommunesMenu.value = false;

    if (commune === 'all') {
        selectedCategory.value = 'communes';
    } else {
        selectedCategory.value = 'communes';
    }

    fetchPhotos();
};

// Fonction pour fermer le menu des communes
const closeCommunesMenu = () => {
    showCommunesMenu.value = false;
    selectedCommune.value = '';
    selectedCategory.value = 'all';
    // Vider aussi la recherche si elle existe
    searchQuery.value = '';
    fetchPhotos();
};

// Fonction pour changer de page
const changePage = (page) => {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page;
        // Scroll vers le haut de la grille des photos
        document.querySelector('.photo-grid')?.scrollIntoView({ behavior: 'smooth' });
    }
};

const fetchPhotos = async () => {
    loading.value = true;
    try {
        let url = `/photos?sort=${sortBy.value}`;

        // Gestion de la recherche
        if (searchQuery.value.trim()) {
            url += `&search=${encodeURIComponent(searchQuery.value.trim())}`;
            console.log('🔍 Recherche:', searchQuery.value.trim());
        }
        // Gestion des filtres
        else if (selectedCommune.value && selectedCommune.value !== 'all') {
            url += `&commune=${selectedCommune.value}`;
        } else if (selectedCategory.value !== 'all') {
            url += `&category=${selectedCategory.value}`;
        }

        const res = await fetch(url);
        const data = await res.json();

        photos.value = data.map(photo => ({
            ...photo,
            isLiked: photo.is_liked_by_user || false,
            isLiking: false
        }));

        // Réinitialiser la pagination à la première page
        currentPage.value = 1;
    } catch (e) {
        console.error('Erreur:', e);
    } finally {
        loading.value = false;
    }
};

// Fonction pour gérer le like/unlike
const toggleLike = async (photo) => {

    if (!isAuthenticated.value) {
        redirectToLogin('Vous devez être connecté pour aimer une photo');
        return;
    }

    if (photo.isLiking) return; // Éviter les clics multiples

    photo.isLiking = true;
    const wasLiked = photo.isLiked;

    try {
        const url = wasLiked
            ? `/photos/${photo.id}/unlike`
            : `/photos/${photo.id}/like`;

        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        });

        const data = await response.json();

        if (response.status === 401) {
            // Utilisateur non connecté - rediriger vers login
            redirectToLogin('Votre session a expiré, veuillez vous reconnecter');
            return;
        }

        if (data.success) {

            // Mettre à jour l'état local immédiatement
            photo.isLiked = !wasLiked;
            photo.likes_count = data.likes_count;

            showToast(
                wasLiked ? 'Like retiré avec succès' : 'Photo likée avec succès !',
                'success'
            );

        } else {
            throw new Error(data.message || 'Erreur lors du like');
        }
    } catch (error) {
        showToast('❌Erreur lors du like', 'error');
    } finally {
        photo.isLiking = false;
    }
};

const sortPhotos = (sort) => {
    sortBy.value = sort;
    fetchPhotos();
};

const selectCategory = (category) => {
    selectedCategory.value = category;
    selectedCommune.value = '';
    showCommunesMenu.value = false;
    searchQuery.value = ''; // Vider la recherche
    fetchPhotos();
};

onMounted(async () => {
    await fetchUser();
    fetchPhotos();
});
</script>