import httpClient from '@/services/httpClient/httpClient';

function index(page, queryParams) {
    return httpClient.get('/food-entries', page, queryParams);
}

export default {
    index
}
