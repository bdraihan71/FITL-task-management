import Task from '../views/task/Task.vue'

const taskRoute = [
    {
        path: '/',
        name: 'Task',
        component: Task,
        meta: { requiresAuth: true }, // only for auth user
    }

]

export default taskRoute