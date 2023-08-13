import { createRouter, createWebHistory } from 'vue-router'
import authRoute from '../routes/authRouter.js'
import taskRoute from '../routes/taskRouter.js'
import { useAuthStore } from '../stores/authStore.js';

const routes = [
    ...authRoute,
    ...taskRoute,
    {
        path: '/:catchAll(.*)',
        redirect: '/',
    }
]

const router = createRouter({
    history: createWebHistory(), routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !useAuthStore().token) {
        next('/login'); // for not auth user redirect to login page
    } else {
        next(); // next router for auth
    }
});

export default router