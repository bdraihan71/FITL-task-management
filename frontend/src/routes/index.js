import{createRouter, createWebHistory} from 'vue-router'
import authRoute from '../routes/authRouter.js'
// import HelloWorld from '../components/HelloWorld.vue'

const routes = [
    ...authRoute,
    // {
    //     path: '/hello',
    //     name: 'HelloWorld',
    //     component: HelloWorld,
    // }
]

const router = createRouter({
    history: createWebHistory(), routes
})

export default router