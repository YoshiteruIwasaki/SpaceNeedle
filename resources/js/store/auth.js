import axios from 'axios';
import Cookies from 'js-cookie';
import {
  OK, UNPROCESSABLE_ENTITY, BAD_REQUEST, UNAUTHORIZED, CREATED,
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
  setRegisterErrorMessages(state, messages) {
    state.registerErrorMessages = messages;
  },
};

const state = {
  user: null,
  token: null,
  apiStatus: null,
  loginErrorMessages: null,
  registerErrorMessages: null,
};

const actions = {
  // 会員登録
  async register(context, data) {
    context.commit('setApiStatus', null);
    const response = await axios.post('/api/register', data);

    if (response.status === CREATED) {
      console.log(response.data);
      context.commit('setApiStatus', true);
      context.commit('setAccessToken', response.data);
      Cookies.set('access_token', response.data.access_token, { expires: 365, path: '' });
      // context.commit('setUser', response.data);
    } else {
      context.commit('setApiStatus', false);
      if (response.status === UNPROCESSABLE_ENTITY) {
        context.commit('setRegisterErrorMessages', response.data.errors);
      } else {
        context.commit('error/setCode', response.status, { root: true });
      }
    }
  },
  // ログイン
  async login(context, data) {
    context.commit('setApiStatus', null);
    data.client_id = window.Client.id;
    data.client_secret = window.Client.secret;
    data.grant_type = 'password';
    data.scope = '*';
    const response = await axios.post('/api/login', data);
    if (response.status === OK) {
      context.commit('setApiStatus', true);
      context.commit('setAccessToken', response.data);
      Cookies.set('access_token', response.data.access_token, { expires: 365, path: '' });
    } else {
      context.commit('setApiStatus', false);
      if (response.status === BAD_REQUEST || response.status === UNAUTHORIZED) {
        context.commit('setLoginErrorMessages', response.data);
      } else {
        context.commit('error/setCode', response.status, { root: true });
      }
    }
  },
  // ログインユーザーチェック
  async user(context) {
    context.commit('setApiStatus', null);
    const response = await axios.get('/api/user', {
      headers: {
        Accept: 'application/json',
      },
    });
    const user = response.data || null;

    if (response.status === OK) {
      context.commit('setApiStatus', true);
      context.commit('setUser', user);
    } else {
      context.commit('setApiStatus', false);
      context.commit('error/setCode', response.status, { root: true });
    }
  },
  // ログアウト
  async logout(context) {
    context.commit('setApiStatus', null);
    const response = await axios.post('/api/logout', {}, {
      headers: {
        Accept: 'application/json',
      },
    });

    if (response.status === OK) {
      context.commit('setApiStatus', true);
      context.commit('setUser', null);
      context.commit('setAccessToken', null);
      Cookies.remove('access_token', { path: '' });
    } else {
      context.commit('setApiStatus', false);
      context.commit('error/setCode', response.status, { root: true });
    }
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
