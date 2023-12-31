import axiosInstance from './axiosInstance.js';
import { useTaskStore } from '../stores/taskStore.js';

const taskApi = axiosInstance

export const createTask = async (task) => {
    try {
        const response = await taskApi.post('/v1/task', {
            title: task.title,
            description: task.description,
            deadline: task.deadline,
            created_for: task.created_for
        });
        const { data, message, status } = response.data
        useTaskStore().createOrUpdateTask(data, message, status)
        return response.data
    } catch (error) {
        throw error.response.data.errors
    }
};

export const updateTask = async (task, taskId) => {
    try {
        const response = await taskApi.put('/v1/task/' + taskId, {
            title: task.title,
            description: task.description,
            status: task.status,
            deadline: task.deadline,
            created_for: task.created_for
        });
        const { data, message, status } = response.data
        useTaskStore().createOrUpdateTask(data, message, status)
        return response.data
    } catch (error) {
        throw error.response.data.errors
    }
};

export const fetchTasks = async () => {
    try {
        const response = await taskApi.get('/v1/my-task')
        return response.data
    } catch (error) {
        throw error;
    }
};

export const userSearchByEmail = async (userEmail) => {
    try {
        if (userEmail.length > 0) {
            const response = await taskApi.get('/users/search/' + '?email=' + userEmail);
            return response.data
        }

    } catch (error) {
        throw error.response.data.errors
    }
};

export const deleteTask = async (taskId) => {
    try {
        const response = await taskApi.delete('/v1/task/' + taskId)
        return response.data
    } catch (error) {
        throw error.response.data.errors;
    }
};

export default taskApi;
