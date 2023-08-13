import { defineStore } from 'pinia';
import { fetchTasks } from '../apis/taskApi.js'

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
        }
    },
});
