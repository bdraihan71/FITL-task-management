import Login from '../views/auth/Login.vue'
import Registration from '../views/auth/Registration.vue'



const authRoute = [
    {
        path: '/login',
        name: 'Login',
        component: Login
    },

    {
        path: '/registration',
        name: 'Registration',
        component: Registration
    },

]


export default authRoute