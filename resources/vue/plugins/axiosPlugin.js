import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";
import store from "@/store";
import router from "@/routes/router";

axios.defaults.baseURL = '/api';

axios.interceptors.request.use(
    config => {
        const token = store.getters['auth/token'];
        if (token) {
            config.headers.common["Authorization"] = 'Bearer ' + token;
        }
        return config;
    },
    error => {
        return Promise.reject(error);
    }
);

axios.interceptors.response.use(function (response) {
    // Any status code that lie within the range of 2xx cause this function to trigger
    // Do something with response data
    return response;
}, function (error) {
    let errorText = '';
    let errorMessage = '';

    if (
        typeof error.response !== 'undefined'
        && typeof error.response.data.data !== 'undefined'
        && typeof error.response.data.data.errors !== 'undefined'
    ) {
        Object.values(error.response.data.data.errors).forEach(function (item) {
            item.forEach(function (text) {
                if (errorText !== '') {
                    errorText = errorText + '<br>';
                }
                errorText = errorText + '• ' +  text;
            });
        });
    }

    if (
        typeof error.response !== 'undefined'
        && typeof error.response.data.data !== 'undefined'
        && typeof error.response.data.data.message !== 'undefined'
    ) {
        errorMessage = error.response.data.data.message;
    }

    Vue.notify({
        group: 'notification',
        type: 'error',
        title: errorMessage || 'Server error',
        text: errorText
    })
    if (error.response.status === 401) {
        store.dispatch('auth/logout');
        router.push({name: 'login'});
    }
    if (error.response.status === 403) {
        router.push({name: 'forbidden'});
    }

    return Promise.reject(error);
});

export default {
    install(Vue) {
        Vue.use(VueAxios, axios);
    }
};
