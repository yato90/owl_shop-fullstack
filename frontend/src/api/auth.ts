import axios from 'axios';
import baseURL from "./index";
//const API_URL = 'http://localhost/api';

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;


export const registerUser = async (userData: any) => {
    try {
        const response = await axios.post(`${baseURL}/register`, userData);
        return response.data;
    } catch (error) {
        throw error;
    }
};

export const loginUser = async (userData: any) => {
    try {
        const response = await axios.post(`${baseURL}/login`, userData);
        const token = response.data.token;
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        localStorage.setItem('token', token);
        return response.data;
    } catch (error) {
        throw error;
    }
};

export const logoutUser = async () => {
    try {
        await axios.post(`${baseURL}/logout`);
        localStorage.removeItem('token');
        delete axios.defaults.headers.common['Authorization'];
    } catch (error) {
        throw error;
    }
    window.location.reload();
};
