import { useAuthStore } from '../stores/authStore.js';
import axiosInstance from './axiosInstance.js'

const authApi = axiosInstance


export const login = async (email, password) => {
    try {
        const response = await authApi.post('/login', { email, password });
        const { token, user } = response.data.data;
        useAuthStore().login(token, user);
        return response.data;
    } catch (error) {
        throw error.response.data.errors;
    }
};

export const signup = async (name, email, password, password_confirmation) => {
    try {
        const response = await authApi.post('/register', { name, email, password, password_confirmation });
        const { token, user } = response.data.data;
        useAuthStore().signup(token, user);
        return response.data;
    } catch (error) {
        throw error.response.data.errors;
    }
};

export const logout = async () => {
    try {
        await authApi.post('/logout');
        useAuthStore().logout();
    } catch (error) {
        throw error;
    }
};

export default authApi;
