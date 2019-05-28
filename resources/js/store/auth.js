import axios from 'axios';

const state = { user: null, token: null };


const getters = {
  check: state => !!state.user,
  username: state => (state.user ? state.user.name : ''),
  accessToken: state => (state.token ? state.token.access_token : ''),
};

const mutations = {
  setUser(state, user) {
    state.user = user;
  },
  setAccessToken(state, token) {
    state.token = token;
  },
};

const actions = {
  async register(context, data) {
    const response = await axios.post('/api/register', data);
    context.commit('setUser', response.data);
  },
  async login(context, data) {
    data.client_id = window.Client.id;
    data.client_secret = window.Client.secret;
    data.grant_type = 'password';
    data.scope = '*';
    const response = await axios.post('/api/login', data);
    context.commit('setAccessToken', response.data);
  },
  async user(context) {
    const response = await axios.get('/api/user', {
      headers: {
        Accept: 'application/json',
        Authorization: `Bearer ${state.token.access_token}`,
      },
    });
    context.commit('setUser', response.data);
  },
  async logout(context) {
    const response = await axios.post('/api/logout', {}, {
      headers: {
        Accept: 'application/json',
        Authorization: `Bearer ${state.token.access_token}`,
      },
    });
    context.commit('setUser', null);
    context.commit('setAccessToken', null);
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
