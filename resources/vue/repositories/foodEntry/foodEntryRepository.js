import httpClient from '@/services/httpClient/httpClient';
import {format} from "date-fns";

function index(page, queryParams) {
    return httpClient.get('/food-entries', page, queryParams);
}

function create(data) {
    data.date_time = format(data.dateTime, 'DD.MM.YYYY HH:mm');
    return httpClient.post('food-entries', data);
}

export default {
    index,
    create
}
