

const mutations = {
  setContent(state, { content, timeout }) {
    state.content = content;

    if (typeof timeout === 'undefined') {
      timeout = 3000;
    }

    setTimeout(() => (state.content = ''), timeout);
  },
};

const state = {
  content: '',
};

export default {
  namespaced: true,
  state,
  mutations,
};
