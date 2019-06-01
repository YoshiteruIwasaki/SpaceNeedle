

const mutations = {
  setCode(state, code) {
    state.code = code;
  },
};
const state = {
  code: null,
};
export default {
  namespaced: true,
  state,
  mutations,
};
