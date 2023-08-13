import { useAuthStore } from '../stores/authStore.js';

export function redirectAuthenticated(to, from, next, redirectPath = '/') {
    if (useAuthStore().token) { // for auth user redirect to specific page
        next(redirectPath);
    } else {
        next();
    }
}
