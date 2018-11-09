export default {
  state: {
    loading: false,
    error: null,
    notify: null
  },
  getters: {
    isLoading (state) {
      return state.loading
    },
    isError (state) {
      return !!state.error
    },
    getError (state) {
      return state.error
    },
    getNotify (state) {
      return state.notify
    },
    isNotify (state) {
      return !!state.notify
    }
  },
  actions: {
    setLoading ({commit}, payload) {
      commit('setLoading', payload)
    },
    setError ({commit}, payload) {
      commit('setError', payload)
    },
    clearError ({commit}) {
      commit('clearError')
    },
    setNotify ({commit}, payload) {
      commit('setError', payload)
    }
  },
  mutations: {
    setLoading (state, payload) {
      state.loading = payload
    },
    setError (state, payload) {
      state.error = payload
    },
    clearError (state) {
      state.error = null
    },
    setNotify (state, payload) {
      state.notify = payload
    },
    clearNotify (state) {
      state.notify = null
    }
  }
}
