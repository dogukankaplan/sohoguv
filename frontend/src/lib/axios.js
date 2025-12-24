import axios from 'axios';

const api = axios.create({
  baseURL: 'https://api.sohoguvenliksistemleri.com.tr/api',
  headers: {  
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
  withCredentials: true, // For Sanctum CSRF protection if using SPA auth, or just tokens
});

api.interceptors.request.use((config) => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

export default api;
