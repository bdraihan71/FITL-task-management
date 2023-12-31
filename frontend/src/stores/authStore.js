import { defineStore } from 'pinia';
import Cookies from 'js-cookie'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        token: Cookies.get('auth_token') || null,
        user: null,
    }),

    getters: {
        isAuthenticated: (state) => !!state.token,
        currentUser: (state) => state.user,
    },

    actions: {
        login(token, user) {
            this.token = token;
            Cookies.set('auth_token', token); // set token after login
            this.user = user;
        },

        signup(token, user) {
            this.token = token;
            Cookies.set('auth_token', token); // set token after signup
            this.user = user;
        },

        logout() {
            this.token = null;
            this.user = null;
            Cookies.remove('auth_token'); // remove token after logout
        },
    },
});
