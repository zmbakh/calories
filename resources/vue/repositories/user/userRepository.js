import httpClient from '@/services/httpClient/httpClient';

function profile() {
    return httpClient.get('/users/profile');
}

export default {
    profile
}
