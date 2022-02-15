import httpClient from '@/services/httpClient/httpClient';

function login(formData) {
    return httpClient.post('/auth/login', formData);
}

function register(formData) {
    return httpClient.post('/auth/register', formData);
}

export default {
    login,
    register
}
