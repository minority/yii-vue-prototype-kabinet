import api from '../library/api'

export default {
  state: {
    incomeDictionaryData: {}
  },
  getters: {
    getIncomeDictionaryData (state) {
      return state.incomeDictionaryData
    }
  },
  actions: {
    async fetchIncomeDictionaryData ({commit}) {
      commit('setLoading', true)
      try {
        const data = await api('get', 'v1/dictionaries/income-indicators')

        commit('setIncomeDictionaryData', data)
        commit('setLoading', false)

        return data
      } catch (e) {
        commit('setLoading', false)
        commit('setError', 'Произошла ошибка загрузки данных фильтров, обратитесь к администратору системы или попробуйте позже')
      }
    }
  },
  mutations: {
    setIncomeDictionaryData (state, payload) {
      state.incomeDictionaryData = payload
    }
  }
}
