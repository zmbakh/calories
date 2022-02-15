import axios from 'axios';

function get(url, page = null, queryParams = {}) {
    let params = page ? {page} : {};
    params = Object.assign(params, queryParams);

    return new Promise((resolve, reject) => {
        axios.get(url, {
            params
        }).then(response => {
            resolve(response.data);
        }).catch(error => {
            reject(error);
        });
    });
}

function getFile(url, queryParams = {}) {
    let config = {
        params: queryParams,
        responseType: 'blob',
    };

    return new Promise((resolve, reject) => {
        axios.get(url, config).then(response => {
            resolve(response);
        }).catch(error => {
            reject(error);
        });
    });
}

function post(url, data = {}) {
    return new Promise((resolve, reject) => {
        axios.post(url, data).then(response => {
            resolve(response.data);
        }).catch(error => {
            reject(error);
        });
    });
}

function postFile(url, formData) {
    return new Promise((resolve, reject) => {
        axios.post(url, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(response => {
            resolve(response.data);
        }).catch(error => {
            reject(error);
        });
    });
}

function put(url, data = {}) {
    data = Object.assign(data, {'_method': 'put'});

    return new Promise((resolve, reject) => {
        axios.post(url, data).then(response => {
            resolve(response.data);
        }).catch(error => {
            reject(error);
        });
    });
}

function destroy(url, queryParams = {}) {
    return new Promise((resolve, reject) => {
        axios.delete(url, {
            params: queryParams
        }).then(response => {
            resolve(response.data);
        }).catch(error => {
            reject(error);
        });
    });
}

export default {
    get,
    getFile,
    post,
    postFile,
    put,
    destroy
}
