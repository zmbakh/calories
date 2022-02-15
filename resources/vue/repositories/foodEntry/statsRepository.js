import httpClient from '@/services/httpClient/httpClient';

function caloriesForToday() {
    return httpClient.get('/calories-limit/check');
}

function caloriesByDay(dateFrom, dateTo) {
    return httpClient.get('/calories-limit/check', {
        date_from: dateFrom,
        date_to: dateTo
    });
}

function monthlyMoneyLimit() {
    return httpClient.get('/money-limit/check-for-month');
}

export default {
    caloriesForToday,
    caloriesByDay,
    monthlyMoneyLimit
}
