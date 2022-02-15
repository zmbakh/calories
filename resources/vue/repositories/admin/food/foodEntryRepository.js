import httpClient from '@/services/httpClient/httpClient';
import {format} from "date-fns";

function index(page, queryParams) {
    return httpClient.get('/admin/food-entries', page, queryParams);
}

function create(data) {
    data.user_id = data.userId;
    data.date_time = format(data.dateTime, 'DD.MM.YYYY HH:mm');
    return httpClient.post('/admin/food-entries', data);
}

export default {
    index,
    create
}
