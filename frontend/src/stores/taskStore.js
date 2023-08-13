import { defineStore } from 'pinia';
import { fetchTasks, deleteTask } from '../apis/taskApi.js'

export const useTaskStore = defineStore('task', {
    state: () => ({
        data: null,
        message: null,
        status: null,
        tasks: []
    }),

    getters: {

    },

    actions: {
        createTask(data, message, status) {
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
    },
});
