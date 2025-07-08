export function showToast(message, type = "success") {
    const toastContainer = document.getElementById("toast-container");

    if (!toastContainer) {
        console.warn("Toast container not found");
        return;
    }

    const toast = document.createElement("div");
    toast.className = `toast toast-${type}`;

    const progress = document.createElement("div");
    progress.className = "toast-progress";

    toast.innerHTML = `
        <span>${message}</span>
        <button class="close-btn" onclick="this.parentElement.remove()">×</button>
    `;
    toast.appendChild(progress);
    toastContainer.appendChild(toast);

    // Animation d'apparition
    setTimeout(() => {
        toast.classList.add("show");
    }, 100);

    // Animation de disparition
    setTimeout(() => {
        toast.classList.add("hide");

        setTimeout(() => {
            if (toast.parentNode) toast.remove();
        }, 400);
    }, 2500);
}
