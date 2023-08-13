import axios from 'axios';
import { useAuthStore } from '../stores/authStore';



const api = axios.create({
    baseURL: 'http://127.0.0.1:8000/api', // base backend api
});


export const login = async (email, password) => {
    try {
        const response = await api.post('/login', { email, password });
        const { token, user } = response.data.data;
        useAuthStore().login(token, user);
        return response.data;
    } catch (error) {
        throw error.response.data.errors;
    }
};

export const signup = async (name, email, password, password_confirmation) => {
    try {
        const response = await api.post('/register', { name, email, password, password_confirmation });
        const { token, user } = response.data.data;
        useAuthStore().signup(token, user);
        return response.data;
    } catch (error) {
        throw error.response.data.errors;
    }
};

export default api;
