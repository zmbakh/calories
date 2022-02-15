import httpClient from '@/services/httpClient/httpClient';

function entitiesAdded() {
    return httpClient.get('/admin/report/entries-added');
}
function averageCalories() {
    return httpClient.get('/admin/report/average-calories');
}

export default {
    entitiesAdded,
    averageCalories
}
