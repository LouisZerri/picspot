import { ref, computed, readonly } from "vue";

const user = ref(window.Laravel?.user || null);
const isAuthenticated = computed(() => !!user.value);

export function useAuth() {
    const login = (userData) => {
        user.value = userData;
    };

    const logout = () => {
        user.value = null;
    };

    const fetchUser = async () => {
        try {
            const response = await fetch("/auth/check", {
                headers: {
                    "X-CSRF-TOKEN":
                        document
                            .querySelector('meta[name="csrf-token"]')
                            ?.getAttribute("content") || "",
                    Accept: "application/json",
                },
            });

            if (response.ok) {
                const data = await response.json();
                user.value = data.user;
                return data;
            } else {
                user.value = null;
                return { authenticated: false, user: null };
            }
        } catch (error) {
            console.error(
                "Erreur lors de la récupération de l'utilisateur:",
                error
            );
            user.value = null;
            return { authenticated: false, user: null };
        }
    };

    const redirectToLogin = (message = "Connectez-vous pour continuer") => {
        sessionStorage.setItem("loginMessage", message);
        window.location.href = "/login";
    };

    const getUserName = () => {
        if (!user.value) return "Invité";
        return (
            `${user.value.firstname || ""} ${
                user.value.lastname || ""
            }`.trim() ||
            user.value.email ||
            "Utilisateur"
        );
    };

    return {
        user: readonly(user),
        isAuthenticated,
        login,
        logout,
        fetchUser,
        redirectToLogin,
        getUserName,
    };
}
