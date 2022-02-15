import Vue from 'vue';

const state = () => ({
    user: null,
    token: localStorage.getItem('access_token'),
})

const getters = {
    user: state => {
        return state.user;
    },
    token: state => {
        return state.token;
    },
    loggedIn: state => {
        return !!state.token;
    }
}

const mutations = {
    setUser(state, user) {
        state.user = user;
    },
    setToken(state, token) {
        state.token = token;
    }
}

const actions = {
    login({commit}, {token, user}) {
        localStorage.setItem('access_token', token);
        commit('setToken', token);
        commit('setUser', user);
    },
    setUser({commit}, user) {
        commit('setUser', user);
    },
    logout({commit}) {
        localStorage.removeItem('access_token');
        commit('setToken', null);
        commit('setUser', null);
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
