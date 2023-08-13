// import axios from 'axios';
import axiosInstance from './axiosInstance.js';


const taskApi = axiosInstance

export const fetchTasks = async () => {
    try {
        const response = await taskApi.get('/v1/my-task')
        return response.data
    } catch (error) {
        throw error;
    }
};

export const deleteTask = async (taskId) => {
    try {
        const response = await taskApi.delete('/v1/task/' + taskId)
        return response.data
    } catch (error) {
        throw error;
    }
};

export default taskApi;