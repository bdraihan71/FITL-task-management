import Login from '../views/auth/Login.vue'
import Registration from '../views/auth/Registration.vue'
import { redirectAuthenticated } from './routerGuards.js'



const authRoute = [
    {
        path: '/login',
        name: 'Login',
        component: Login,
        beforeEnter: (to, from, next) => redirectAuthenticated(to, from, next, '/')
    },

    {
        path: '/registration',
        name: 'Registration',
        component: Registration,
        beforeEnter: (to, from, next) => redirectAuthenticated(to, from, next, '/')
    },

]


export default authRoute