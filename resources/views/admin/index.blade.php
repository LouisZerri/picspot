@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-600 to-blue-600 text-white p-6 rounded-t-lg">
            <h1 class="text-3xl font-bold flex items-center">
                <i class="fas fa-shield-alt mr-3"></i>
                Administration des Photos
            </h1>
            <p class="text-purple-100 mt-2">Gestion complète des photos publiées</p>
        </div>

        <!-- Messages -->
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mx-6 mt-4" role="alert">
            <div class="flex">
                <div class="py-1">
                    <i class="fas fa-check-circle mr-2"></i>
                </div>
                <div>
                    <strong class="font-bold">Succès!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mx-6 mt-4" role="alert">
            <div class="flex">
                <div class="py-1">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                </div>
                <div>
                    <strong class="font-bold">Erreur!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            </div>
        </div>
        @endif

        <!-- Statistiques -->
        <div class="p-6 border-b">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-images text-blue-500 text-2xl mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-600">Total Photos</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $totalPictures }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-heart text-green-500 text-2xl mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-600">Total Likes</p>
                            <p class="text-2xl font-bold text-green-600">{{ $totalLikes }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-purple-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-users text-purple-500 text-2xl mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-600">Contributeurs</p>
                            <p class="text-2xl font-bold text-purple-600">{{ $totalContributors }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-orange-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-calendar text-orange-500 text-2xl mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-600">Aujourd'hui</p>
                            <p class="text-2xl font-bold text-orange-600">{{ $todayPictures }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions en masse -->
        <div class="p-6 border-b bg-gray-50">
            <form id="bulkDeleteForm" method="POST" action="{{ route('admin.bulk-delete') }}">
                @csrf
                <div class="flex items-center space-x-4">
                    <button type="button" id="selectAllBtn" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-check-square mr-2"></i>
                        Tout sélectionner
                    </button>
                    <button type="button" id="bulkDeleteBtn" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors" disabled>
                        <i class="fas fa-trash mr-2"></i>
                        Supprimer la sélection
                    </button>
                    <span id="selectedCount" class="text-gray-600"></span>
                </div>
            </form>
        </div>

        <!-- Tableau des photos -->
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Image
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Titre
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Catégorie
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Localisation
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Likes
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pictures as $picture)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="picture-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                                   value="{{ $picture->id }}" name="picture_ids[]">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img src="{{ asset($picture->image_path) }}" alt="{{ $picture->title }}" 
                                     class="w-16 h-16 rounded-lg object-cover shadow-md cursor-pointer hover:shadow-lg transition-shadow"
                                     onclick="showImageModal('{{ asset($picture->image_path) }}', '{{ $picture->title }}')">
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900 max-w-xs truncate" title="{{ $picture->title }}">
                                {{ $picture->title }}
                            </div>
                            @php
                                // Gérer les tags qu'ils soient array ou string JSON
                                $tags = $picture->tags;
                                if (is_string($tags)) {
                                    $tags = json_decode($tags, true) ?? [];
                                } elseif (!is_array($tags)) {
                                    $tags = [];
                                }
                            @endphp
                            @if($tags && count($tags) > 0)
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @foreach($tags as $tag)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ getCategoryBadgeClass($picture->category) }}">
                                {{ $picture->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center text-sm text-gray-900">
                                <i class="fas fa-map-marker-alt text-gray-400 mr-1"></i>
                                <span class="max-w-xs truncate" title="{{ $picture->location }}">{{ $picture->location }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <i class="fas fa-heart text-red-500 mr-1"></i>
                                <span class="text-sm font-medium text-gray-900">{{ $picture->likes_count }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>{{ $picture->created_at->format('d/m/Y') }}</div>
                            <div class="text-xs text-gray-400">{{ $picture->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                @if($picture->link)
                                    <a href="{{ $picture->link }}" target="_blank" 
                                       class="text-blue-600 hover:text-blue-900 transition-colors" 
                                       title="Voir le lien">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                @endif
                                <form method="POST" action="{{ route('admin.pictures.delete', $picture->id) }}" 
                                      style="display: inline;" 
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer la photo \'{{ addslashes($picture->title) }}\' ? Cette action est irréversible.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 transition-colors" 
                                            title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-images text-4xl text-gray-300 mb-4"></i>
                            <p class="text-lg font-medium">Aucune photo trouvée</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($pictures->hasPages())
        <div class="p-6 border-t">
            <div class="flex items-center justify-between">
                <div class="flex-1 flex justify-between sm:hidden">
                    @if ($pictures->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                            Précédent
                        </span>
                    @else
                        <a href="{{ $pictures->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            Précédent
                        </a>
                    @endif

                    @if ($pictures->hasMorePages())
                        <a href="{{ $pictures->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            Suivant
                        </a>
                    @else
                        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                            Suivant
                        </span>
                    @endif
                </div>

                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700 leading-5">
                            Affichage de
                            <span class="font-medium">{{ $pictures->firstItem() }}</span>
                            à
                            <span class="font-medium">{{ $pictures->lastItem() }}</span>
                            sur
                            <span class="font-medium">{{ $pictures->total() }}</span>
                            résultats
                        </p>
                    </div>

                    <div>
                        <span class="relative z-0 inline-flex shadow-sm rounded-md">
                            {{-- Bouton Précédent --}}
                            @if ($pictures->onFirstPage())
                                <span aria-disabled="true" aria-label="Précédent">
                                    <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5" aria-hidden="true">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </span>
                            @else
                                <a href="{{ $pictures->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Précédent">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endif

                            {{-- Éléments de pagination --}}
                            @foreach ($pictures->getUrlRange(1, $pictures->lastPage()) as $page => $url)
                                @if ($page == $pictures->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-purple-600 border border-purple-600 cursor-default leading-5">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="Aller à la page {{ $page }}">{{ $page }}</a>
                                @endif
                            @endforeach

                            {{-- Bouton Suivant --}}
                            @if ($pictures->hasMorePages())
                                <a href="{{ $pictures->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Suivant">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @else
                                <span aria-disabled="true" aria-label="Suivant">
                                    <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md leading-5" aria-hidden="true">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal pour afficher l'image -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="relative max-w-4xl max-h-full p-4">
        <button onclick="closeImageModal()" class="absolute top-2 right-2 text-white hover:text-gray-300 text-2xl z-10">
            <i class="fas fa-times"></i>
        </button>
        <img id="modalImage" class="max-w-full max-h-full rounded-lg shadow-2xl" alt="">
        <div class="absolute bottom-4 left-4 right-4 bg-black bg-opacity-50 text-white p-4 rounded">
            <h3 id="modalTitle" class="text-lg font-semibold"></h3>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
.hover\:scale-105:hover {
    transform: scale(1.05);
}
</style>
@endpush

@push('scripts')
<script>
// Fonction pour obtenir la classe CSS du badge de catégorie
function getCategoryBadgeClass(category) {
    const badgeClasses = {
        'Monuments': 'bg-purple-100 text-purple-800',
        'Restaurants': 'bg-red-100 text-red-800',
        'Hôtels': 'bg-green-100 text-green-800',
        'Bars/Cafés': 'bg-yellow-100 text-yellow-800',
        'Activités': 'bg-indigo-100 text-indigo-800',
        'Immobilier': 'bg-cyan-100 text-cyan-800',
    };
    return badgeClasses[category] || 'bg-gray-100 text-gray-800';
}

// Gestion des checkboxes
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const pictureCheckboxes = document.querySelectorAll('.picture-checkbox');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    const selectedCount = document.getElementById('selectedCount');
    const selectAllBtn = document.getElementById('selectAllBtn');

    // Fonction pour mettre à jour le compteur et le bouton
    function updateBulkActions() {
        const selectedCheckboxes = document.querySelectorAll('.picture-checkbox:checked');
        const count = selectedCheckboxes.length;
        
        selectedCount.textContent = count > 0 ? `${count} photo(s) sélectionnée(s)` : '';
        bulkDeleteBtn.disabled = count === 0;
        
        // Mettre à jour l'état du checkbox "tout sélectionner"
        selectAllCheckbox.checked = count === pictureCheckboxes.length && count > 0;
        selectAllCheckbox.indeterminate = count > 0 && count < pictureCheckboxes.length;
    }

    // Gestion du checkbox "tout sélectionner"
    selectAllCheckbox.addEventListener('change', function() {
        pictureCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateBulkActions();
    });

    // Gestion du bouton "tout sélectionner"
    selectAllBtn.addEventListener('click', function() {
        const allChecked = document.querySelectorAll('.picture-checkbox:checked').length === pictureCheckboxes.length;
        pictureCheckboxes.forEach(checkbox => {
            checkbox.checked = !allChecked;
        });
        updateBulkActions();
    });

    // Gestion des checkboxes individuelles
    pictureCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });

    // Gestion de la suppression en masse
    bulkDeleteBtn.addEventListener('click', function() {
        const selectedIds = Array.from(document.querySelectorAll('.picture-checkbox:checked')).map(cb => cb.value);
        
        if (selectedIds.length === 0) {
            alert('Veuillez sélectionner au moins une photo à supprimer.');
            return;
        }

        if (confirm(`Êtes-vous sûr de vouloir supprimer ${selectedIds.length} photo(s) ? Cette action est irréversible.`)) {
            // Ajouter les IDs sélectionnés au formulaire
            selectedIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'picture_ids[]';
                input.value = id;
                document.getElementById('bulkDeleteForm').appendChild(input);
            });
            
            document.getElementById('bulkDeleteForm').submit();
        }
    });

    // Initialiser l'état
    updateBulkActions();
});

// Fonctions pour le modal d'image
function showImageModal(imageSrc, title) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('imageModal').classList.remove('hidden');
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
}

// Fermer le modal en cliquant en dehors
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});

// Fermer le modal avec Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>
@endpush

@php
function getCategoryBadgeClass($category) {
    $badgeClasses = [
        'Monuments' => 'bg-purple-100 text-purple-800',
        'Restaurants' => 'bg-red-100 text-red-800',
        'Hôtels' => 'bg-green-100 text-green-800',
        'Bars/Cafés' => 'bg-yellow-100 text-yellow-800',
        'Activités' => 'bg-indigo-100 text-indigo-800',
        'Immobilier' => 'bg-cyan-100 text-cyan-800',
    ];
    return $badgeClasses[$category] ?? 'bg-gray-100 text-gray-800';
}
@endphp