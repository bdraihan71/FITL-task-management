import { defineStore } from 'pinia';
import { fetchTasks, deleteTask, userSearchByEmail } from '../apis/taskApi.js'

export const useTaskStore = defineStore('task', {
    state: () => ({
        data: null,
        message: null,
        status: null,
        tasks: [],
        myData: {},
        users: []
    }),

    getters: {
        usersEmail: (state) => state.users.map(user => user.email )
    },

    actions: {
        createOrUpdateTask(data, message, status) {
            this.data = data;
            this.message = message;
            this.status = status;
        },

        async fetchTasks() {
            try {
                const tasks = await fetchTasks();
                this.tasks = tasks.data;
            } catch (error) {
                throw error;
            }
        },

        async deleteTask(taskId) {
            try {
                await deleteTask(taskId);
                const updatedTasks = this.tasks.filter(task => task.id !== taskId)
                this.tasks = updatedTasks
            } catch (error) {
                throw error;
            }
        },

        async userSearchByEmail(searchData) {
            try {
                const users = await userSearchByEmail(searchData)
                this.users = users.data
            } catch (error) {
                this.users = []
                throw error;
            }
        },

        passingTaskValue(task) {
            this.myData.id = task.id
            this.myData.title = task.title
            this.myData.description = task.description
            this.myData.status = task.status
            this.myData.deadline = task.deadline
            this.myData.created_for = task.created_for
        }
    },
});
