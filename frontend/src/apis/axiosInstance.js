import axios from 'axios';
import { useAuthStore } from '../stores/authStore'; // pinia store for auth 


const axiosInstance = axios.create({
    baseURL: 'http://127.0.0.1:8000/api', // base backend api
    headers: {
        'Content-Type': 'application/json',
    },
});


axiosInstance.interceptors.request.use(config => {
    const token = useAuthStore().token;

    if (token) {
        config.headers['Authorization'] = `Bearer ${token}`;  //bearer token for auth
    }

    return config;
});

export default axiosInstance;
