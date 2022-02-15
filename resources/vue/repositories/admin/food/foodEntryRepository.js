import httpClient from '@/services/httpClient/httpClient';
import {format} from "date-fns";

function index(page, queryParams) {
    return httpClient.get('/admin/food-entries', page, queryParams);
}

function show(id) {
    return httpClient.get(`/admin/food-entries/${id}`);
}

function create(data) {
    data.user_id = data.userId;
    data.date_time = format(data.dateTime, 'DD.MM.YYYY HH:mm');
    return httpClient.post('/admin/food-entries', data);
}

function update(id, data) {
    data.date_time = format(data.dateTime, 'DD.MM.YYYY HH:mm');
    return httpClient.put(`/admin/food-entries/${id}`, data);
}

function destroy(id) {
    return httpClient.destroy(`/admin/food-entries/${id}`);
}

export default {
    index,
    show,
    create,
    update,
    destroy
}
