import { showToast } from "./utils/toast.js";
import { createApp } from 'vue';
import Pictures from './components/Pictures.vue';

const app = createApp({});
app.component('Pictures', Pictures);
app.mount('#app');

document.addEventListener("DOMContentLoaded", () => {
    processFlashMessages();
    initPasswordToggle();
    initImagePreview();
    initTagsManagement();
});

function processFlashMessages() {
    const flash = document.getElementById("toast-data");

    const isBackNavigation =
        performance.getEntriesByType("navigation")[0]?.type === "back_forward";

    if (flash && !isBackNavigation) {
        const success = flash.dataset.success;
        const status = flash.dataset.status;
        const errors = JSON.parse(flash.dataset.errors || "[]");

        if (success) showToast(success, "success");
        if (status) showToast(status, "info");
        errors.forEach((msg) => showToast(msg, "error"));
    }

    if (flash) flash.remove();
}

function initPasswordToggle() {
    const toggleButton = document.querySelector('[onclick="togglePassword()"]');
    if (toggleButton) {
        toggleButton.removeAttribute('onclick');
        toggleButton.addEventListener('click', togglePassword);
    }
}

function togglePassword() {
    const passwordField = document.getElementById("password");
    const eyeIcon = document.getElementById("eye-icon");

    if (!passwordField || !eyeIcon) return;

    if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 11-4.243-4.243m4.242 4.242L9.88 9.88"/>
        `;
    } else {
        passwordField.type = "password";
        eyeIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        `;
    }
}

// Fonction pour initialiser la prévisualisation d'image
function initImagePreview() {
    const imageInput = document.getElementById('image');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const removePreview = document.getElementById('remove-preview');

    if (!imageInput || !previewContainer || !previewImage || !removePreview) {
        return; // Éléments non trouvés, probablement pas sur la page d'ajout de photo
    }

    // Gestion de l'upload d'image
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Vérifier la taille du fichier (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                showToast('La taille du fichier ne doit pas dépasser 5MB', 'error');
                imageInput.value = '';
                return;
            }

            // Vérifier le type de fichier
            if (!file.type.startsWith('image/')) {
                showToast('Veuillez sélectionner une image valide', 'error');
                imageInput.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    // Gestion du bouton de suppression
    removePreview.addEventListener('click', function() {
        imageInput.value = '';
        previewContainer.classList.add('hidden');
        previewImage.src = '';
    });

    // Gestion du drag & drop
    const dropZone = imageInput.closest('.border-dashed');
    if (dropZone) {
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropZone.classList.add('border-purple-400', 'bg-purple-50');
        });

        dropZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            dropZone.classList.remove('border-purple-400', 'bg-purple-50');
        });

        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropZone.classList.remove('border-purple-400', 'bg-purple-50');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                imageInput.files = files;
                // Déclencher l'événement change
                imageInput.dispatchEvent(new Event('change'));
            }
        });
    }
}

// Fonction pour initialiser la gestion des tags
function initTagsManagement() {
    let tags = [];
    const maxTags = 3;
    const tagInput = document.getElementById('tag-input');
    const addTagBtn = document.getElementById('add-tag-btn');
    const tagsContainer = document.getElementById('tags-container');
    const tagsHidden = document.getElementById('tags-hidden');

    if (!tagInput || !addTagBtn || !tagsContainer || !tagsHidden) {
        return; // Éléments non trouvés
    }

    function updateTagsDisplay() {
        tagsContainer.innerHTML = '';
        tags.forEach((tag, index) => {
            const tagElement = document.createElement('div');
            tagElement.className = 'flex items-center bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm';
            tagElement.innerHTML = `
                <span>${tag}</span>
                <button type="button" class="ml-2 text-purple-500 hover:text-purple-700" onclick="removeTag(${index})">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;
            tagsContainer.appendChild(tagElement);
        });
        tagsHidden.value = JSON.stringify(tags);
    }

    function addTag() {
        const tagValue = tagInput.value.trim();
        if (!tagValue) {
            showToast('Veuillez saisir un tag', 'error');
            return;
        }

        if (tags.length >= maxTags) {
            showToast(`Vous ne pouvez ajouter que ${maxTags} tags maximum`, 'error');
            return;
        }

        if (tags.includes(tagValue)) {
            showToast('Ce tag existe déjà', 'error');
            return;
        }

        if (tagValue.length > 20) {
            showToast('Un tag ne peut pas dépasser 20 caractères', 'error');
            return;
        }

        tags.push(tagValue);
        tagInput.value = '';
        updateTagsDisplay();
        showToast(`Tag "${tagValue}" ajouté`, 'success');
    }

    // Fonction globale pour supprimer un tag
    window.removeTag = function(index) {
        const removedTag = tags[index];
        tags.splice(index, 1);
        updateTagsDisplay();
        showToast(`Tag "${removedTag}" supprimé`, 'info');
    };

    // Event listeners
    addTagBtn.addEventListener('click', addTag);
    
    tagInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addTag();
        }
    });

    // Initialiser les tags depuis les données existantes (pour les erreurs de validation)
    const existingTags = tagsHidden.value;
    if (existingTags) {
        try {
            const parsedTags = JSON.parse(existingTags);
            if (Array.isArray(parsedTags)) {
                tags = parsedTags;
                updateTagsDisplay();
            }
        } catch (e) {
            console.error('Erreur lors du parsing des tags existants:', e);
        }
    }
}