import axios from 'axios';
import Cookies from 'js-cookie';
import {
  OK, UNPROCESSABLE_ENTITY, BAD_REQUEST, UNAUTHORIZED,
} from '../util';

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
  setApiStatus(state, status) {
    state.apiStatus = status;
  },
  setLoginErrorMessages(state, messages) {
    state.loginErrorMessages = messages;
  },
};

const state = {
  user: null,
  token: null,
  apiStatus: null,
  loginErrorMessages: null,
};

const actions = {
  async register(context, data) {
    const response = await axios.post('/api/register', data);
    context.commit('setUser', response.data);
  },
  async login(context, data) {
    context.commit('setApiStatus', null);
    data.client_id = window.Client.id;
    data.client_secret = window.Client.secret;
    data.grant_type = 'password';
    data.scope = '*';
    const response = await axios.post('/api/login', data).catch(err => err.response || err);
    if (response.status === OK) {
      context.commit('setApiStatus', true);
      context.commit('setAccessToken', response.data);
      Cookies.set('access_token', response.data.access_token, { expires: 365, path: '' });
    } else {
      context.commit('setApiStatus', false);
      if (response.status === BAD_REQUEST || response.status === UNAUTHORIZED) {
        context.commit('setLoginErrorMessages', response.data);
      } else if (response.status === UNPROCESSABLE_ENTITY) {
        context.commit('setLoginErrorMessages', response.data.errors);
      } else {
        context.commit('error/setCode', response.status, { root: true });
      }
    }
  },
  async user(context) {
    const response = await axios.get('/api/user', {
      headers: {
        Accept: 'application/json',
      },
    });
    const user = response.data || null;
    context.commit('setUser', user);
  },
  async logout(context) {
    await axios.post('/api/logout', {}, {
      headers: {
        Accept: 'application/json',
      },
    });
    context.commit('setUser', null);
    context.commit('setAccessToken', null);
    Cookies.remove('access_token', { path: '' });
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
