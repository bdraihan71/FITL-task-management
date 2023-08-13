import { defineStore } from 'pinia';
import { fetchTasks, deleteTask } from '../apis/taskApi.js'

export const useTaskStore = defineStore('task', {
    state: () => ({
        tasks: []
    }),

    getters: {

    },

    actions: {
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
