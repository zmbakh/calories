import httpClient from '@/services/httpClient/httpClient';

function index() {
    return httpClient.get('/admin/users');
}

export default {
    index
}
